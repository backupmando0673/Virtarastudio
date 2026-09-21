import { cva } from 'class-variance-authority';

export const badgeVariants = cva(
    'inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 select-none',
    {
        variants: {
            variant: {
                default:
                    'border-transparent bg-orange-500 text-white shadow hover:bg-orange-600',
                secondary:
                    'border-transparent bg-slate-100 text-slate-800 hover:bg-slate-200',
                outline: 'text-slate-800 border-slate-200',
                orangeSoft:
                    'border-orange-200/80 bg-orange-50 text-orange-700 font-medium',
                greenSoft:
                    'border-green-200/80 bg-green-50 text-green-700 font-medium',
            },
        },
        defaultVariants: {
            variant: 'default',
        },
    }
);

export { default as Badge } from './Badge.vue';
