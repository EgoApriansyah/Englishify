import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Core
                green: {
                    DEFAULT: '#22C55E',
                    dark:    '#16A34A',
                    light:   '#DCFCE7',
                    muted:   '#BBF7D0',
                },
                // Accents
                blue: {
                    DEFAULT: '#3B82F6',
                    light:   '#DBEAFE',
                },
                yellow: {
                    DEFAULT: '#EAB308',
                    light:   '#FEF9C3',
                },
                red: {
                    DEFAULT: '#EF4444',
                    light:   '#FEE2E2',
                },
                purple: {
                    DEFAULT: '#8B5CF6',
                    light:   '#EDE9FE',
                },
                // Neutrals
                ink:       '#111827',
                body:      '#374151',
                muted:     '#6B7280',
                hairline:  '#E5E7EB',
                surface:   '#F9FAFB',
                canvas:    '#FFFFFF',
            },
            fontFamily: {
                sans:    ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                body:    ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'display-xl':    ['48px', { lineHeight: '1.15', letterSpacing: '-0.03em', fontWeight: '800' }],
                'display-lg':    ['36px', { lineHeight: '1.2', letterSpacing: '-0.02em', fontWeight: '700' }],
                'display-md':    ['28px', { lineHeight: '1.25', letterSpacing: '-0.01em', fontWeight: '700' }],
                'display-sm':    ['22px', { lineHeight: '1.3', letterSpacing: '0', fontWeight: '700' }],
                'title-lg':      ['18px', { lineHeight: '1.4', letterSpacing: '0', fontWeight: '600' }],
                'title-md':      ['16px', { lineHeight: '1.4', letterSpacing: '0', fontWeight: '600' }],
                'body-lg':       ['18px', { lineHeight: '1.65', letterSpacing: '0', fontWeight: '400' }],
                'body-md':       ['16px', { lineHeight: '1.6', letterSpacing: '0', fontWeight: '400' }],
                'body-sm':       ['14px', { lineHeight: '1.55', letterSpacing: '0', fontWeight: '400' }],
                'label-lg':      ['14px', { lineHeight: '1.4', letterSpacing: '0.04em', fontWeight: '600' }],
                'label-sm':      ['12px', { lineHeight: '1.35', letterSpacing: '0.06em', fontWeight: '600' }],
                'score-display': ['64px', { lineHeight: '1.0', letterSpacing: '-0.04em', fontWeight: '800' }],
                'xp-number':     ['32px', { lineHeight: '1.1', letterSpacing: '-0.02em', fontWeight: '700' }],
            },
            borderRadius: {
                'xs':   '4px',
                'sm':   '8px',
                'md':   '12px',
                'lg':   '16px',
                'pill': '9999px',
            },
            boxShadow: {
                'sm':   '0 1px 2px rgba(17, 24, 39, 0.06)',
                'md':   '0 4px 12px rgba(17, 24, 39, 0.08), 0 1px 3px rgba(17, 24, 39, 0.05)',
                'lg':   '0 8px 24px rgba(17, 24, 39, 0.10), 0 2px 8px rgba(17, 24, 39, 0.06)',
                'card': '0 1px 3px rgba(17, 24, 39, 0.07), 0 0 0 1px rgba(17, 24, 39, 0.04)',
            },
            maxWidth: {
                'container': '1280px',
            },
            transitionTimingFunction: {
                'entrance': 'cubic-bezier(0.16, 1, 0.3, 1)',
                'bounce':   'cubic-bezier(0.34, 1.56, 0.64, 1)',
            },
        },
    },

    plugins: [forms],
};
