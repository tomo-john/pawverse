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
            isMoving: false,

            init () {
                if (this.behavior.type === 'sleep') {
                    this.sleep();
                }

                if (this.behavior.type === 'follow') {
                    this.follow();
                }

                if (this.behavior.type === 'wander') {
                    this.wander();
                }

                console.log(this.selectedDog.status.stamina);
                console.log(this.behavior.type);
            },

            sleep() {
            },

            follow() {
                setInterval(() => {
                    const targetX = this.$data.mouseX;
                    const targetY = this.$data.mouseY;
                    const dx = targetX - this.x;
                    const dy = targetY - this.y;

                    if (Math.abs(dx) > 5) {
                        this.x += dx * 0.1 * this.behavior.speed;
                    }
                    if (Math.abs(dy) >5) {
                        this.y += dy * 0.1 * this.behavior.speed;
                    }
                }, 30);

            },

            wander () {
                const parent = this.$el.parentElement;

                setInterval(() => {
                    this.x = Math.random() * parent.clientWidth;
                    this.y = Math.random() * parent.clientHeight;
                }, 3000 / this.behavior.speed);
            },

        }
    }
</script>
