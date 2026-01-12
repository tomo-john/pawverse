document.addEventListener('alpine:init', () => {
    Alpine.data('sandboxUi', (initial = {}) => ({

        // state
        name: initial.name ?? 'no name',
        color: initial.color ?? 'white',
        size: initial.size ?? '1',

        // computed
        sizeClass() {
            return {
                1: 'text-xl',
                2: 'text-2xl',
                3: 'text-3xl',
                4: 'text-4xl',
                5: 'text-5xl',
                6: 'text-6xl',
                7: 'text-7xl',
                8: 'text-8xl',
                9: 'text-9xl',
            }[this.size]
        },

        colorClass() {
            return {
                white: 'text-white drop-shadow',
                black: 'text-black',
            }[this.color]
        },

    }))
})
