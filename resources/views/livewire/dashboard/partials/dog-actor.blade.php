<div
    x-data="dogActor(
        {{ Js::from($dog) }},
        {{ Js::from($behavior) }},
    )"
    class="absolute pointer-events-none"
    :style="{ left: x + 'px', top: y + 'px' }"
>
    <div :class="isLeft ? '-scale-x-100' : 'scale-x-100'">
        <div :class="stateClass" class="relative">
            <i class="fa-solid fa-dog" :class="dog.size_class" :style="{color: dog.color}"></i>
            <span x-show="state === 'sleeping'"
                  class="absolute -top-6 left-1/2 text-xs text-gray-400"
            >
                <span class="dog-zzz inline-block" style="animation-delay: 0s;">z</span>
                <span class="dog-zzz inline-block" style="animation-delay: 0.3s;">z</span>
                <span class="dog-zzz inline-block" style="animation-delay: 0.6s;">z</span>
            </span>
        </div>
    </div>
</div>

<script>
    function dogActor(dog, behavior) {
        return {
            dog,
            behavior,

            x: Math.random() * 300,
            y: Math.random() * 300,
            isLeft: false,
            state: 'idle', // idle | moving | sniffing | sleeping

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

            moveToward(targetX, targetY, speed) {
                const dx = targetX - this.x;
                const dy = targetY - this.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < 10) {
                    this.state = 'sniffing';
                    return false;
                }

                this.state = 'moving';

                this.x += (dx / distance) * speed;
                this.y += (dy / distance) * speed;

                this.isLeft = dx < 0;

                return true;
            },

            sleep() {
                this.state = 'sleeping';
            },

            follow() {
                setInterval(() => {
                    this.moveToward(
                        this.$data.mouseX,
                        this.$data.mouseY,
                        this.behavior.speed * 2
                    );
                }, 30);

            },

            wander () {
                let targetX = this.x;
                let targetY = this.y;

                setInterval(() => {
                    const parent = this.$el.parentElement;
                    targetX = Math.random() * parent.clientWidth;
                    targetY = Math.random() * parent.clientHeight;
                }, 5000);

                setInterval(() => {
                    this.moveToward(targetX, targetY, this.behavior.speed * 2);
                }, 30)
            },

            get stateClass() {
                return {
                    'dog-move': this.state === 'moving',
                    'dog-sleep': this.state === 'sleeping',
                    'dog-kunkun': this.state === 'sniffing',
                }
            },
        }
    }
</script>
