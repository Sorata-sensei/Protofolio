    
    function toggleDarkMode() {
        const button = document.getElementById('theme-toggle');
        let theme = localStorage.getItem('theme');
        if (theme === 'dark') {
             button.innerHTML = `<i class="fa-regular fa-sun"></i>`;
            localStorage.setItem('theme', 'light');
            document.getElementById('theme-stylesheet').href = '/css/light.css';
        } else {
             button.innerHTML = `<i class="fa-regular fa-moon"></i>`;
            localStorage.setItem('theme', 'dark');
            document.getElementById('theme-stylesheet').href = '/css/dark.css';
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const button = document.getElementById('theme-toggle');
        let theme = localStorage.getItem('theme');
        if (theme === 'dark') {
             button.innerHTML = `<i class="fa-regular fa-moon"></i>`;
            document.getElementById('theme-stylesheet').href = '/css/dark.css';
        } else {
             button.innerHTML = `<i class="fa-regular fa-sun"></i>`;
            document.getElementById('theme-stylesheet').href = '/css/light.css';
        }
    });
 