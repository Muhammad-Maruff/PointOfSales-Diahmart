// Create animated floating shapes
function createShapes() {
    const shapes = document.querySelector('.floating-shapes');
    const shapeCount = 15;
    
    for(let i = 0; i < shapeCount; i++) {
        const shape = document.createElement('div');
        shape.classList.add('shape');
        
        // Set random positions and dimensions
        const randomPosition = {
            left: Math.random() * 100,
            top: Math.random() * 100,
            size: Math.random() * 100 + 20
        };
        
        shape.style.left = `${randomPosition.left}%`;
        shape.style.top = `${randomPosition.top}%`;
        shape.style.width = `${randomPosition.size}px`;
        shape.style.height = `${randomPosition.size}px`;
        shape.style.animationDelay = `${Math.random() * 20}s`;
        
        shapes.appendChild(shape);
    }
}

// Handle password visibility toggle
function initializePasswordToggles() {
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            const isPasswordVisible = input.type === 'password';
            input.type = isPasswordVisible ? 'text' : 'password';
            
            icon.classList.toggle('ti-eye', !isPasswordVisible);
            icon.classList.toggle('ti-eye-off', isPasswordVisible);
        });
    });
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.floating-shapes')) {
        createShapes();
        initializePasswordToggles();
    }
});
