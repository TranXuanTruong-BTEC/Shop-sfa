@extends('layouts.frontend')

@section('title', 'Trang chủ')

@section('content')
<!-- Featured Categories Section -->
<section class="py-24 relative bg-gradient-to-b from-gray-100 to-white">
    <!-- Static Background - Sử dụng màu nền tạm thời -->
    <div class="absolute inset-0 bg-gray-100"></div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-gray-900 mb-16">Shop by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(['Women', 'Men', 'Accessories'] as $category)
            <a href="#" class="group relative overflow-hidden rounded-2xl aspect-[4/5]">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent z-10"></div>
                <!-- Sử dụng placeholder image -->
                <img src="{{ asset('images/categories/'.strtolower($category).'.jpg') }}" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                     alt="{{ $category }}">
                <div class="absolute bottom-0 left-0 right-0 p-8 z-20">
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $category }}</h3>
                    <p class="text-gray-200 mb-4">Explore Collection</p>
                    <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-purple-600 transition-colors">
                        <svg class="w-6 h-6 text-white transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script type="module">
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/examples/jsm/postprocessing/UnrealBloomPass.js';
import gsap from 'gsap';
import Splitting from 'splitting';

// Initialize 3D Scene
const initScene = () => {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({
        canvas: document.querySelector('#heroCanvas'),
        antialias: true,
        alpha: true
    });
    
    // Add post-processing effects
    const composer = new EffectComposer(renderer);
    const renderPass = new RenderPass(scene, camera);
    const bloomPass = new UnrealBloomPass(
        new THREE.Vector2(window.innerWidth, window.innerHeight),
        1.5, 0.4, 0.85
    );
    composer.addPass(renderPass);
    composer.addPass(bloomPass);

    // Add animated geometry
    const geometry = new THREE.TorusKnotGeometry(10, 3, 100, 16);
    const material = new THREE.MeshPhongMaterial({
        color: 0x6366f1,
        wireframe: true
    });
    const torusKnot = new THREE.Mesh(geometry, material);
    scene.add(torusKnot);

    // Animation loop
    const animate = () => {
        requestAnimationFrame(animate);
        torusKnot.rotation.x += 0.01;
        torusKnot.rotation.y += 0.01;
        composer.render();
    };
    animate();
};

// Initialize text effects
Splitting();

// Initialize magnetic effect
const magneticButtons = document.querySelectorAll('.magnetic-wrap');
magneticButtons.forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
        const bounds = btn.getBoundingClientRect();
        const x = e.clientX - bounds.left - bounds.width / 2;
        const y = e.clientY - bounds.top - bounds.height / 2;
        
        gsap.to(btn, {
            duration: 0.6,
            x: x * 0.3,
            y: y * 0.3,
            ease: 'power2.out'
        });
    });

    btn.addEventListener('mouseleave', () => {
        gsap.to(btn, {
            duration: 0.6,
            x: 0,
            y: 0,
            ease: 'elastic.out(1, 0.3)'
        });
    });
});

// Initialize gradient animation
const gradient = new Gradient();
gradient.initGradient('#gradient-canvas');

// Initialize on load
window.addEventListener('load', () => {
    initScene();
});
</script>
@endpush

@push('styles')
<style>
/* Glitch Effect */
.glitch-text {
    position: relative;
    animation: glitch 1s infinite;
}

@keyframes glitch {
    0% { transform: translate(0) }
    20% { transform: translate(-2px, 2px) }
    40% { transform: translate(-2px, -2px) }
    60% { transform: translate(2px, 2px) }
    80% { transform: translate(2px, -2px) }
    100% { transform: translate(0) }
}

/* Morphing Text */
.text-morphing span {
    animation: morphText 8s infinite;
}

@keyframes morphText {
    0%, 100% { opacity: 0; transform: translateY(20px); }
    20%, 80% { opacity: 1; transform: translateY(0); }
}

/* Custom Cursor */
.custom-cursor {
    width: 20px;
    height: 20px;
    background: rgba(99, 102, 241, 0.2);
    border-radius: 50%;
    position: fixed;
    pointer-events: none;
    z-index: 9999;
    transition: transform 0.2s ease;
}

/* Perspective Settings */
.perspective-1000 {
    perspective: 1000px;
}

.preserve-3d {
    transform-style: preserve-3d;
}

/* Gradient Animation */
#gradient-canvas {
    width: 100%;
    height: 100%;
    --gradient-color-1: #6366f1;
    --gradient-color-2: #8b5cf6;
    --gradient-color-3: #d946ef;
    --gradient-color-4: #ec4899;
}

</style>
@endpush