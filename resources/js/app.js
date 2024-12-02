document.addEventListener("DOMContentLoaded", () => {
    function updateDuration(startTime) {
        const now = new Date();
        const start = new Date(startTime);
        const diff = Math.floor((now - start) / 1000); // Diferencia en segundos

        const hours = Math.floor(diff / 3600);
        const minutes = Math.floor((diff % 3600) / 60);
        const seconds = diff % 60;

        return `${hours.toString().padStart(2, "0")}:${minutes
            .toString()
            .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
    }

    setInterval(() => {
        // Actualiza la duración actual
        const currentDurationElement =
            document.getElementById("current-duration");
        if (currentDurationElement) {
            const startTime = currentDurationElement.dataset.startTime;
            currentDurationElement.textContent = updateDuration(startTime);
        }

        // Actualiza las jornadas "En curso"
        const dynamicDurations = document.querySelectorAll(".dynamic-duration");
        dynamicDurations.forEach((element) => {
            const startTime = element.dataset.startTime;
            element.textContent = updateDuration(startTime);
        });
    }, 1000);
});
