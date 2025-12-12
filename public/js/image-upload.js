document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('cover_image');
    const previewImage = document.getElementById('preview-image');

    // Allowed extensions and size (2MB)
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    const maxSizeMB = 2;
    const maxSizeBytes = maxSizeMB * 1024 * 1024;

    if (imageInput) {
        imageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            // Clear preview if no file selected (or cancelled)
            if (!file) {
                // Keep existing preview if in edit mode (we logic this by checking if src is not empty initiall, but simpler to just do nothing or hide if no file?)
                // Actually if user cancels, we might want to revert? But typically file input clears.
                // For this requirement: "If invalid image -> show message and clear file input."
                return;
            }

            const fileName = file.name.toLowerCase();
            const fileExtension = fileName.split('.').pop();

            // Validate Extension
            if (!allowedExtensions.includes(fileExtension)) {
                alert(`Invalid file type. Allowed: ${allowedExtensions.join(', ')}`);
                imageInput.value = ''; // Clear input
                previewImage.style.display = 'none'; // Hide preview
                return;
            }

            // Validate Size
            if (file.size > maxSizeBytes) {
                alert(`File is too large. Max size is ${maxSizeMB}MB.`);
                imageInput.value = ''; // Clear input
                previewImage.style.display = 'none'; // Hide preview
                return;
            }

            // Show Preview
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    }
});
