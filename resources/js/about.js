// resources/js/about.js

document.addEventListener('DOMContentLoaded', function () {
    class NeonBeam {
        constructor(canvasId, wrapperId, colors) {
            this.canvas = document.getElementById(canvasId);
            this.wrapper = document.getElementById(wrapperId);
            if (!this.canvas || !this.wrapper) return;

            this.ctx = this.canvas.getContext('2d');
            this.time = 0;
            this.colors = colors;

            this.init();
        }

        init() {
            window.addEventListener('resize', () => this.resize());
            this.resize();
            this.animate();
        }

        resize() {
            if (!this.wrapper || !this.canvas) return;
            // Adjust for DPI/Scale
            const dpr = window.devicePixelRatio || 1;
            const rect = this.wrapper.getBoundingClientRect();

            this.canvas.width = rect.width * dpr;
            this.canvas.height = rect.height * dpr;

            this.ctx.scale(dpr, dpr);

            // CSS size
            this.canvas.style.width = `${rect.width}px`;
            this.canvas.style.height = `${rect.height}px`;
        }

        getPosition(progress, w, h) {
            const perimeter = 2 * (w + h);
            let pos = (progress % 1) * perimeter;
            if (pos < 0) pos += perimeter;

            let x, y;
            if (pos < w) {
                x = pos; y = 0;
            } else if (pos < (w + h)) {
                x = w; y = pos - w;
            } else if (pos < (2 * w + h)) {
                x = w - (pos - (w + h)); y = h;
            } else {
                x = 0; y = h - (pos - (2 * w + h));
            }
            return { x, y };
        }

        drawBeam(color, offset, speed) {
            const w = this.canvas.width / (window.devicePixelRatio || 1);
            const h = this.canvas.height / (window.devicePixelRatio || 1);
            const progress = (this.time * speed + offset);

            const tailLength = 0.4; // 40% of perimeter - matching the requested "long" look
            const segments = 40;     // High density for perfect smoothness

            this.ctx.lineCap = 'round';
            this.ctx.lineJoin = 'round';

            // Draw Neon Glow (Outer)
            for (let i = segments; i >= 0; i--) {
                const segProgress = progress - (i * (tailLength / segments));
                const pos = this.getPosition(segProgress, w, h);
                const prevPos = this.getPosition(segProgress - (tailLength / segments), w, h);

                const alpha = 1 - (i / segments);

                // Outer Blur
                this.ctx.shadowBlur = 10 * alpha;
                this.ctx.shadowColor = color;
                this.ctx.strokeStyle = color;
                this.ctx.lineWidth = 4 * alpha;
                this.ctx.globalAlpha = alpha * 0.3;

                this.ctx.beginPath();
                this.ctx.moveTo(prevPos.x, prevPos.y);
                this.ctx.lineTo(pos.x, pos.y);
                this.ctx.stroke();
            }

            // Draw Core Neon Beam
            for (let i = segments; i >= 0; i--) {
                const segProgress = progress - (i * (tailLength / segments));
                const pos = this.getPosition(segProgress, w, h);
                const prevPos = this.getPosition(segProgress - (tailLength / segments), w, h);

                const alpha = 1 - (i / segments);

                this.ctx.shadowBlur = 0;
                this.ctx.strokeStyle = color;
                this.ctx.lineWidth = 2 * alpha;
                this.ctx.globalAlpha = alpha;

                this.ctx.beginPath();
                this.ctx.moveTo(prevPos.x, prevPos.y);
                this.ctx.lineTo(pos.x, pos.y);
                this.ctx.stroke();

                // Bright highlight at the very head
                if (i === 0) {
                    this.ctx.shadowBlur = 15;
                    this.ctx.shadowColor = '#fff';
                    this.ctx.fillStyle = '#fff';
                    this.ctx.beginPath();
                    this.ctx.arc(pos.x, pos.y, 1.5, 0, Math.PI * 2);
                    this.ctx.fill();
                }
            }
            this.ctx.globalAlpha = 1.0;
            this.ctx.shadowBlur = 0;
        }

        animate() {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

            this.time += 0.0025; // Dynamic speed adjustment

            this.drawBeam(this.colors.orange, 0, 1);    // Tiger Orange Beam
            this.drawBeam(this.colors.blue, 0.5, 1);     // Primary Blue Beam (Start at opposite end)

            requestAnimationFrame(() => this.animate());
        }
    }

    // Colors matching the brand and the provided stock motion graphic intensity
    const brandColors = {
        orange: '#f59e0b', // Brand Orange
        blue: '#2dd4bf'    // Neon Cyan (Variation of brand blue for high visibility neon)
    };

    new NeonBeam('ledCanvas', 'portraitWrapper', brandColors);
    new NeonBeam('contactLedCanvas', 'contactBtnWrapper', brandColors);
});
