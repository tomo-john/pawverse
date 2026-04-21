<div
    x-data="dogActor({{ Js::from($dog) }}, {{ Js::from($behavior) }})"
    class="absolute pointer-events-none"
    :style="{ left: x + 'px', top: y + 'px' }"
>
    <i class="fa-solid fa-dog transition-transform duration-300"
       :class="[
           dog.size_class,
           isLeft ? '-scale-x-100' : 'scale-x-100',
           isSniffing ? 'dog-kunkun' : ''
       ]"
       :style="{color: dog.color}"
    ></i>
</div>

<script>
    function dogActor(dog, behavior) {
        return {
            dog,
            behavior,
            x: Math.random() * 300,
            y: Math.random() * 300,
            isLeft: false,
            isMoving: false,
            isSniffing: false,

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
            },

            sleep() {
            },

            follow() {
                setInterval(() => {
                    if (Math.random() < 0.05) {
                        this.isMoving = false;
                        return;
                    }

                    const targetX = this.$data.mouseX;
                    const targetY = this.$data.mouseY;

                    const dx = targetX - this.x;
                    const dy = targetY - this.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 20) {
                        this.isSniffing = true;
                        this.isMoving = false;
                        return;
                    }

                    this.isSniffing = false;
                    this.isMoving = true;

                    const speed = this.behavior.speed * 2;

                    this.x += (dx / distance) * speed;
                    this.y += (dy / distance) * speed;

                    this.isLeft = dx < 0;
                }, 30);

            },

            wander () {
                let targetX = this.x;
                let targetY = this.y;
                this.isSniffing = false;

                setInterval(() => {
                    const parent = this.$el.parentElement;
                    targetX = Math.random() * parent.clientWidth;
                    targetY = Math.random() * parent.clientHeight;
                    this.isSniffing = false;
                }, 5000);

                setInterval(() => {
                    const dx = targetX - this.x;
                    const dy = targetY - this.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 10) {
                        this.isSniffing = true;
                        return;
                    }

                    const speed = this.behavior.speed * 2;

                    this.x += (dx / distance) * speed;
                    this.y += (dy / distance) * speed;

                    this.isLeft = dx < 0;
                }, 30)
            },

        }
    }
</script>
