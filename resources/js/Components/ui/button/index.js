import { cva } from 'class-variance-authority';

export const buttonVariants = cva(
    'inline-flex items-center justify-center whitespace-nowrap rounded-xl text-sm font-medium ring-offset-white transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-orange-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 select-none',
    {
        variants: {
            variant: {
                default:
                    'bg-orange-500 text-white hover:bg-orange-600 shadow-sm shadow-orange-500/20 hover:shadow-md hover:shadow-orange-500/30 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98]',
                destructive:
                    'bg-red-500 text-white hover:bg-red-600 shadow-sm',
                outline:
                    'border border-slate-200 bg-white hover:bg-orange-50/70 hover:border-orange-200 text-slate-800 hover:text-orange-600',
                secondary:
                    'bg-slate-100 text-slate-900 hover:bg-slate-200/80',
                ghost:
                    'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600',
                link:
                    'text-orange-500 underline-offset-4 hover:underline',
                whatsapp:
                    'bg-[#25D366] text-white hover:bg-[#20ba59] shadow-md shadow-green-500/20 hover:scale-[1.02] active:scale-[0.98] font-semibold',
            },
            size: {
                default: 'h-11 px-5 py-2.5',
                sm: 'h-9 rounded-lg px-3.5 text-xs',
                lg: 'h-12 rounded-xl px-7 text-base font-semibold',
                icon: 'h-10 w-10 p-0',
            },
        },
        defaultVariants: {
            variant: 'default',
            size: 'default',
        },
    }
);

export { default as Button } from './Button.vue';
