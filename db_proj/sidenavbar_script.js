document.addEventListener('DOMContentLoaded', () => {
    const userProfile = document.querySelector('.user-profile-container');
    const dropdown = document.querySelector('.profile-dropdown-menu');
    const icon = userProfile.querySelector('.dropdown-icon i');

    userProfile.addEventListener('click', e => {
      e.stopPropagation();
      const isHidden = dropdown.hasAttribute('hidden');
      dropdown.toggleAttribute('hidden');
      icon.classList.toggle('fa-chevron-down', !isHidden);
      icon.classList.toggle('fa-chevron-up', isHidden);

      // Toggle background opacity
      userProfile.classList.toggle('active', isHidden);
    });

    document.addEventListener('click', () => {
      if (!dropdown.hasAttribute('hidden')) {
        dropdown.setAttribute('hidden', '');
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        userProfile.classList.remove('active');
      }
    });
  });