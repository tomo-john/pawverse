document.addEventListener('alpine:init', () => {
    Alpine.data('dogForm', (initial) => ({
        name: initial.name ?? '',
        color: initial.color ?? 'gray',
        size: initial.size ?? 'medium',

        sizeClass() {
            return {
                small: 'text-4xl',
                medium: 'text-6xl',
                large: 'text-8xl',
            }[this.size]
        },

        colorClass() {
            return {
                white: 'text-white drop-shadow',
                black: 'text-black',
                gray: 'text-gray-500',
                brown: 'text-amber-800',
                gold: 'text-yellow-500',
            }[this.color]
        },
    }))
})
