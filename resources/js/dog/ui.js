document.addEventListener('alpine:init', () => {
    Alpine.data('dogUi', (initial = {}) => ({

        // state
        name: initial.name ?? '',
        color: initial.color ?? 'gray',
        size: initial.size ?? 3,

        isHoverd: false,

        // computed
        sizeClass() {
            const size = Number(this.size)

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
            }[this.size] ?? 'text-3xl'
        },

        colorClass() {
            return {
                white: 'text-white drop-shadow',
                black: 'text-black',
                gray: 'text-gray-500',
                brown: 'text-amber-800',
                gold: 'text-yellow-600',
                red: 'text-red-500',
                blue: 'text-blue-500',
                pink: 'text-pink-500',
                violet: 'text-violet-500',
            }[this.color] ?? 'text-black'
        },

    }))
})
