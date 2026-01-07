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
