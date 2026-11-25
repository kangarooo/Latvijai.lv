#!/usr/bin/env python3
"""Ģenerē assets/css/elementor-native.css no tēmas CSS.

Sākumlapa no Elementor pamatelementiem lieto tās pašas tēmas klases, taču
Elementor konteineri un logrīki uzliek savu izkārtojumu (display, padding,
margin, gap…). Šis skripts paņem tēmas noteikumus sākumlapas klasēm un
izkārtojuma īpašības atkārto ar stiprāku selektoru (#primary.latvijai-elementor),
bet .btn / .link-arrow noteikumus pārnes uz Elementor pogas logrīku.

Palaist: python3 tools/build-elementor-css.py
"""
import os
import re

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SOURCES = [os.path.join(ROOT, 'style.css'), os.path.join(ROOT, 'assets/css/theme.css')]
OUT = os.path.join(ROOT, 'assets/css/elementor-native.css')
HEADER = os.path.join(ROOT, 'tools/elementor-native-base.css')
PREFIX = '#primary.latvijai-elementor'

CLASSES = set('''
container section hero hero-inner hero-copy hero-eyebrow hero-title hero-text hero-actions hero-meta
hero-status hero-coords mission mission-grid mission-title mission-body lead stats-grid stat stat-number
stat-number--accent stat-label mission-link section-head section-line eyebrow eyebrow-index latvia latvia-panel latvia-copy
latvia-title latvia-text latvia-meta latvia-link latvia-regions latvia-region latvia-region-index
latvia-region-copy section-top section-title projects spotlight spotlight-panel spotlight-content
spotlight-title spotlight-text spotlight-alphabet spotlight-alphabet-label spotlight-alphabet-letters
journal cta-section cta-panel cta-title cta-text cta-actions cta-meta text-outline
'''.split())

LAYOUT = re.compile(r'^(display|position|inset|top|right|bottom|left|margin(-[a-z-]+)?|padding(-[a-z-]+)?|gap|row-gap|column-gap|'
                    r'grid(-[a-z-]+)?|width|max-width|min-width|height|min-height|max-height|flex(-[a-z-]+)?|'
                    r'align-[a-z-]+|justify-[a-z-]+|place-[a-z-]+|order|overflow(-[xy])?|z-index|text-align|border-radius|transition|background(-[a-z]+)?)$')
BUTTON = re.compile(r'\.(btn(?:-[a-z]+)?|link-arrow)\b((?::[a-z-]+(?:\([^)]*\))?)*)')
ROOTISH = re.compile(r'^((?::root|html|body)(?:\[[^\]]*\]|\.[\w-]+|:[\w-]+(?:\([^)]*\))?)*)\s+')


def strip_comments(css):
    return re.sub(r'/\*.*?\*/', '', css, flags=re.S)


def parse(css, media=None):
    """Yield (media, selector, body) for every plain rule, recursing into @media."""
    i = 0
    while i < len(css):
        j = css.find('{', i)
        if j < 0:
            return
        head = css[i:j].strip()
        depth, k = 1, j + 1
        while depth and k < len(css):
            if css[k] == '{':
                depth += 1
            elif css[k] == '}':
                depth -= 1
            k += 1
        body = css[j + 1:k - 1]
        if head.startswith('@media'):
            yield from parse(body, head)
        elif not head.startswith('@'):
            yield media, head, body
        i = k


def classes_in(selector):
    return set(re.findall(r'\.([\w-]+)', selector))


def prefix(selector):
    m = ROOTISH.match(selector)
    if m:
        return m.group(1) + ' ' + PREFIX + ' ' + selector[m.end():]
    return PREFIX + ' ' + selector


def decls(body):
    out = []
    for part in body.split(';'):
        if ':' not in part:
            continue
        prop, val = part.split(':', 1)
        out.append((prop.strip(), val.strip()))
    return out


def main():
    layout_rules, button_rules = [], []
    for path in SOURCES:
        css = strip_comments(open(path, encoding='utf-8').read())
        for media, head, body in parse(css):
            sels = [s.strip() for s in head.split(',') if s.strip()]
            d = decls(body)

            btn = [s for s in sels if BUTTON.search(s)]
            if btn:
                mapped = [BUTTON.sub(lambda m: '.elementor-widget-button.lv-' + m.group(1) + ' .elementor-button' + m.group(2), s) for s in btn]
                # Tēmas ikona (.icon) → ::after uz Elementor pogas (ikonu nosaka lv-icon-* klase).
                mapped = [re.sub(r'(\.elementor-button(?::[a-z-]+)*) \.icon\b', r'\1 .elementor-button-content-wrapper::after', s) for s in mapped]
                mapped = [PREFIX + ' ' + s if not ROOTISH.match(s) else prefix(s) for s in mapped]
                button_rules.append((media, mapped, d))

            ours = [s for s in sels if classes_in(s) & CLASSES and not BUTTON.search(s)]
            if not ours:
                continue
            # Pseudo-elementiem (::before/::after) Elementor pārraksta arī saturu — tos kopē pilnībā.
            pseudo = [s for s in ours if re.search(r':(:)?(before|after)\b', s)]
            if pseudo:
                layout_rules.append((media, [prefix(s) for s in pseudo], d))
                ours = [s for s in ours if s not in pseudo]
                if not ours:
                    continue
            ld = [(p, v) for p, v in d if LAYOUT.match(p)]
            # Elementor "lazy load background images" uzliek background-image: none !important
            # konteineriem no trešā uz leju, līdz savs skripts tos atzīmē — tēmas paneļiem
            # tas nenotiek. Tāpēc tēmas foni šeit ir !important.
            ld = [(p, v + ' !important' if p.startswith('background') and '!important' not in v else v) for p, v in ld]
            has_flex = any(p == 'display' and 'flex' in v for p, v in ld)
            if has_flex and not any(p in ('flex-direction', 'flex-flow') for p, _ in ld):
                ld.append(('flex-direction', 'row'))
            if ld:
                layout_rules.append((media, [prefix(s) for s in ours], ld))

    def emit(rules):
        out, current = [], None
        for media, sels, d in rules:
            if media != current:
                if current:
                    out.append('}\n')
                if media:
                    out.append(media + ' {\n')
                current = media
            ind = '\t' if media else ''
            out.append(ind + (',\n' + ind).join(sels) + ' {\n')
            for p, v in d:
                out.append(ind + '\t' + p + ': ' + v + ';\n')
            out.append(ind + '}\n')
        if current:
            out.append('}\n')
        return ''.join(out)

    base = open(HEADER, encoding='utf-8').read()
    with open(OUT, 'w', encoding='utf-8') as f:
        f.write(base.rstrip() + '\n\n/* ---- Izkārtojums no tēmas CSS (ģenerēts) ---- */\n')
        f.write(emit(layout_rules))
        f.write('\n/* ---- Pogas: .btn / .link-arrow → Elementor poga (ģenerēts) ---- */\n')
        f.write(emit(button_rules))
    print('wrote', OUT, len(layout_rules), 'layout rules,', len(button_rules), 'button rules')


if __name__ == '__main__':
    main()
