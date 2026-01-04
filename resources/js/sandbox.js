document.addEventListener('DOMContentLoaded', () => {
    console.log('sandbox js loaded 🐶');

    const dog = document.getElementById('dog');

    if (!dog) return;

    dog.addEventListener('click', () => {
        dog.classList.toggle('scale-125');
        console.log(dog);
    });

    const rightDog = document.getElementById('right-dog');

    if (!rightDog) return;

    rightDog.addEventListener('click', () => {
        rightDog.classList.toggle('translate-x-[700px]');
        console.log(rightDog);
    });
});

// DogFormテスト
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
