<div
    x-data="dogActor()"
    class="absolute transition-all duration-1000"
    :style="{
        left: x + 'px',
        top: y + 'px'
    }"
>
    <i class="fa-solid fa-dog"
       :class="selectedDog.size_class"
       :style="{color: selectedDog.color}"
    ></i>
</div>

<script>
    function dogActor() {
        return {
            x: 100,
            y: 100,

            init () {
                this.wander();
                console.log(this.selectedDog.status.level);
            },

            wander () {
                const parent = this.$el.parentElement;
                console.log(parent.clientWidth);

                setInterval(() => {
                    this.x = Math.random() * parent.clientWidth;
                    this.y = Math.random() * parent.clientHeight;
                }, 3000);
            },
        }
    }
</script>
