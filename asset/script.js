document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll(".survey-section");
    const tabs = document.querySelectorAll(".tab");
    const progressFill = document.getElementById("progress-fill");
    let currentSection = 0;

    // Show section by index
    function showSection(index) {
        sections.forEach((section, i) => {
            section.style.display = (i === index) ? "block" : "none";
        });
        tabs.forEach((tab, i) => {
            tab.classList.toggle("active", i === index);
        });
        updateProgress(index);
    }

    // Update progress bar
    function updateProgress(index) {
        const percentage = ((index) / (sections.length - 2)) * 100; // minus Thank You section
        progressFill.style.width = `${percentage}%`;
    }

    // Validate required inputs in a section
    function validateSection(index) {
        let valid = true;
        const requiredFields = sections[index].querySelectorAll("input[required], textarea[required], select[required]");
        const errorMessages = sections[index].querySelectorAll(".error-message");

        errorMessages.forEach(msg => msg.style.display = "none");

        requiredFields.forEach(field => {
            if (field.type === "radio") {
                const name = field.name;
                const checked = sections[index].querySelector(`input[name="${name}"]:checked`);
                if (!checked) {
                    valid = false;
                    const errorId = field.closest(".form-group").querySelector(".error-message");
                    if (errorId) errorId.style.display = "block";
                }
            } else if (!field.value.trim()) {
                valid = false;
                const errorId = field.closest(".form-group").querySelector(".error-message");
                if (errorId) errorId.style.display = "block";
            }
        });

        return valid;
    }

    // Button actions
    document.getElementById("btn-section-1").addEventListener("click", () => {
        if (validateSection(0)) {
            currentSection = 1;
            showSection(currentSection);
        }
    });

    document.getElementById("btn-section-2").addEventListener("click", () => {
        if (validateSection(1)) {
            currentSection = 2;
            showSection(currentSection);
        }
    });

    document.getElementById("btn-section-3").addEventListener("click", () => {
        currentSection = 3;
        showSection(currentSection);
    });

    document.getElementById("btn-back-section-2").addEventListener("click", () => {
        currentSection = 0;
        showSection(currentSection);
    });

    document.getElementById("btn-back-section-3").addEventListener("click", () => {
        currentSection = 1;
        showSection(currentSection);
    });

    document.getElementById("btn-back-section-4").addEventListener("click", () => {
        currentSection = 2;
        showSection(currentSection);
    });


     // Tab click navigation
    tabs.forEach((tab, i) => {
        tab.addEventListener("click", () => {
            if (i <= currentSection) {
                currentSection = i;
                showSection(currentSection);
            }
        });
    });

    // Initialize
    showSection(currentSection);
});
