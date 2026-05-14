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
            {{-- Dog --}}
            <i class="fa-solid fa-dog" :class="dog.size_class" :style="{color: dog.color}"></i>

            {{-- zzz --}}
            <span x-show="state === 'sleeping'"
                  class="absolute -top-6 left-1/2 text-xs flex items-end gap-1"
            >
                <span class="dog-zzz inline-flex justify-center items-center" style="animation-delay: 0s;"><i class="fa-solid fa-z text-gray-400"></i></span>
                <span class="dog-zzz inline-flex justify-center items-center" style="animation-delay: 0.3s;"><i class="fa-solid fa-z text-gray-400"></i></span>
                <span class="dog-zzz inline-flex justify-center items-center" style="animation-delay: 0.6s;"><i class="fa-solid fa-z text-gray-400"></i></span>
            </span>

            {{-- Bubble --}}
            <span
                x-show="bubble"
                class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs"
                x-transition.opacity
            >
                <span x-show="bubble === 'happy'"><i class="fa-solid fa-music text-black"></i></span>
                <span x-show="bubble === 'alert'"><i class="fa-solid fa-exclamation text-pink-500"></i></span>
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
            bubble: null,

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
                this.showBubble('sleep', 3000);
            },

            follow() {
                setInterval(() => {
                    this.moveToward(this.$data.mouseX, this.$data.mouseY,this.behavior.speed * 2);
                }, 30);

            },

            wander () {
                let targetX = this.x;
                let targetY = this.y;

                setInterval(() => {
                    const parent = this.$el.parentElement;
                    targetX = Math.random() * parent.clientWidth;
                    targetY = Math.random() * parent.clientHeight;

                    if (Math.random() < 0.3) {
                        this.showBubble('happy', 1000);
                    }

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

            showBubble(type, duration = 2000) {
                this.bubble = type;

                setTimeout(() => {
                    if (this.bubble === type) {
                        this.bubble = null;
                    }
                }, duration)
            },
        }
    }
</script>
