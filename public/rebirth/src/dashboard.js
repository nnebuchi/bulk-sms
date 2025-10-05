// src/dashboard.js
// document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  const toggleButton = document.getElementById("sidebar-toggle");
  const dropdownButtons = document.querySelectorAll("[data-dropdown-toggle]");
  const logoFull = document.querySelector(".logo-full");
  const logoIcon = document.querySelector(".logo-icon");
  const profileDropdown = document.getElementById("dropdown-user");
  const iconsToResize = document.querySelectorAll(".icon-adjust svg");
  const aiComposeToggle = document.getElementById("ai-compose-toggle");
  const aiPromptContainer = document.getElementById("ai-prompt-container");
  const messageContentTextarea = document.getElementById("message-content");
  const profileToggle = document.getElementById("profile-toggle");
  const sendLaterButton = document.getElementById("send-later-button");
  const scheduleFields = document.getElementById("schedule-fields");
  const filterButton = document.getElementById("filter-button");
  const filterCriteria = document.getElementById("filter-criteria");
  const applyFilterButton = document.getElementById("apply-filter-button");
  const resetFilterButton = document.getElementById("reset-filter-button");
  const mobileMenuToggle = document.getElementById("toggleMobileNav");
  const mobileSideBar = document.getElementById("sidebar");
  const closeMobileMenu = document.getElementById("mobileNavClose");

  profileToggle.addEventListener("click", () => {
    if (profileDropdown.classList.contains("hidden")) {
      profileDropdown.classList.remove("hidden");
    } else {
      profileDropdown.classList.add("hidden");
    }
  });

  if (toggleButton) {
    toggleButton.addEventListener("click", () => {
      if (sidebar.classList.contains("sidebar-collapsed")) {
        iconsToResize.forEach((icon) => {
          icon.style.width = "28px";
          icon.style.height = "28px";
        });
      } else {
        iconsToResize.forEach((icon) => {
          icon.style.width = "24px";
          icon.style.height = "24px";
        });
      }
      body.classList.toggle("sidebar-collapsed");
      logoFull.classList.toggle("hidden");
      logoIcon.classList.toggle("hidden");
    });
  }
  // Logic for dropdown menus
  dropdownButtons.forEach((button) => {
    button.addEventListener("click", () => {
      // The condition is removed, so this will always run
      const targetId = button.getAttribute("data-dropdown-toggle");
      const targetMenu = document.getElementById(targetId);
      const icon = button.querySelector("svg.chevron");

      // Close other dropdowns
      document
        .querySelectorAll("[data-dropdown-toggle]")
        .forEach((otherBtn) => {
          const otherMenu = document.getElementById(
            otherBtn.getAttribute("data-dropdown-toggle")
          );
          if (otherMenu && otherMenu !== targetMenu) {
            otherMenu.classList.add("hidden");
            otherBtn
              .querySelector("svg.chevron")
              .classList.remove("rotate-180");
          }
        });

      targetMenu.classList.toggle("hidden");
      icon.classList.toggle("rotate-180");
    });
  });

  const tagInput = document.getElementById("tag-input");
  const tagsWrapper = document.getElementById("tags-wrapper");

  // Function to create a new tag element
  function createTag(text) {
    const tag = document.createElement("span");
    tag.className =
      "flex items-center space-x-1 bg-yellow-100 text-yellow-7000 px-2 py-1 rounded-md text-sm mr-2 mb-2";
    tag.innerHTML = `
            <span class="inputted-number-holder">${text}</span>
            <button type="button" class="tag-remove text-gray-500 hover:text-gray-800 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
    return tag;
  }

  // Function to add a tag to the wrapper
  function addTag(value) {
    const trimmedValue = value;
    if (trimmedValue) {
      const newTag = createTag(trimmedValue);
      tagsWrapper.appendChild(newTag);
      tagInput.value = "";
      let existingContacts =  document.getElementById("contact-input").value 
      if(existingContacts?.length == 0){
        document.getElementById("contact-input").value = value
      }else{
        document.getElementById("contact-input").value = existingContacts + "," + value
      }
    }
    toggleRecipientsList();
  }
  const toggleRecipientsList = () => {
    // check if a tag is already created
    if (tagsWrapper.children.length > 0) {
      document.querySelector('.import-contact-button').style.display = 'none';
      document.querySelector("#send-option").value = "manual_input";
    }else{
      document.querySelector('.import-contact-button').style.display = 'flex';
      document.querySelector("#send-option").value = "";
    }
  }

  tagInput?.addEventListener("keydown", (e) => {
    const value = e.target.value;

    if (e.key === "," || e.key === " " || e.key === "Enter") {
      e.preventDefault();
      addTag(value);
      
    }
  });

  tagsWrapper?.addEventListener("click", (e) => {
    if (e.target.closest(".tag-remove")) {
      e.target.closest(".tag-remove").parentNode.remove();
    }
    toggleRecipientsList();
  });

  // Auto compose switch
  aiComposeToggle?.addEventListener("change", (event) => {
    if (event.target.checked) {
      aiPromptContainer.classList.remove("hidden");
      messageContentTextarea.disabled = true;
      // messageContentTextarea.value = "";
      messageContentTextarea.placeholder =
        "AI will compose the message here...";
    } else {
      aiPromptContainer.classList.add("hidden");
      messageContentTextarea.disabled = false;
      messageContentTextarea.placeholder = "Start typing...";
    }
  });

  // Optional: Listen for click on the "Compose" button
  const composeButton = document.querySelector("#ai-prompt-container button");
  composeButton?.addEventListener("click", () => {
    const prompt = document.getElementById("ai-prompt").value;
    if (prompt) {
      // Simulate AI response (replace with actual API call)
      const aiResponse = `Hello there! This is a message generated by AI based on your prompt: "${prompt}".`;

      // Update the main message textarea with the AI's response
      messageContentTextarea.value = aiResponse;
    }
  });

  sendLaterButton?.addEventListener("click", () => {
    const isHidden = scheduleFields.classList.contains("hidden");

    if (isHidden) {
      scheduleFields.classList.remove("hidden");
      sendLaterButton.textContent = "Schedule";
    } else {
      console.log("Message is now scheduled!");
    }
  });

  // Toggle the visibility of the filter criteria
  filterButton?.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevents the document click listener from immediately closing it
    filterCriteria.classList.toggle("hidden");
  });

  // Close the dropdown when clicking outside of it
  document.addEventListener("click", (event) => {
    if (
      !filterCriteria?.contains(event.target) &&
      !filterButton?.contains(event.target)
    ) {
      filterCriteria?.classList.add("hidden");
    }
  });

  // Handle Apply Filter button click (conceptual logic)
  applyFilterButton?.addEventListener("click", () => {
    const category = document.getElementById("filter-category").value;
    const dateRange = document.getElementById("filter-date-range").value;

    // Implement your filtering logic here
    console.log(
      `Applying filter: Category = ${category}, Date Range = ${dateRange}`
    );

    // Close the dropdown after applying the filter
    filterCriteria.classList.add("hidden");
  });

  // Handle Reset Filter button click
  resetFilterButton?.addEventListener("click", () => {
    document.getElementById("filter-category").value = "";
    document.getElementById("filter-date-range").value = "";

    // Implement logic to reset your data display
    console.log("Filters have been reset.");

    // Close the dropdown after resetting the filter
    filterCriteria.classList.add("hidden");
  });

  // Mobile Sidnav Responsive control

  mobileMenuToggle?.addEventListener("click", () => {
    if (mobileSideBar?.classList.contains("hidden")) {
      mobileSideBar?.classList.remove("hidden");
    } else {
      mobileSideBar.classList.add("hidden");
    }
  });
  closeMobileMenu?.addEventListener("click", () => {
    mobileSideBar?.classList.add("hidden");
  });

  function handlePaste(e) {
    e.preventDefault(); // stop default paste

    // get pasted text
    const pasted = (e.clipboardData || window.clipboardData).getData("text"); 
    
    // split by comma and process
    // document.getElementById("contact-input").value = pasted;
    pasted.split(",").forEach(val => {
      val = val.trim();
      if (val) {
        addTag(val);
      }
    });
  }


  
  // --- 1. API Public Token Logic ---

  // Public Token Elements
  const publicTokenInput = document.getElementById("api-public-token-input");
  const publicVisibilityIcon = document.getElementById(
    "public-visibility-toggle-icon"
  );
  const publicCopyIcon = document.getElementById("public-copy-icon");

  if (publicTokenInput && publicVisibilityIcon && publicCopyIcon) {
    // Visibility Toggle
    publicVisibilityIcon.addEventListener("click", () => {
      if (publicTokenInput.type === "password") {
        publicTokenInput.type = "text";
        publicVisibilityIcon.classList.remove("fa-eye");
        publicVisibilityIcon.classList.add("fa-eye-slash");
      } else {
        publicTokenInput.type = "password";
        publicVisibilityIcon.classList.remove("fa-eye-slash");
        publicVisibilityIcon.classList.add("fa-eye");
      }
    });

    // Copy Logic
    publicCopyIcon.addEventListener("click", async () => {
      await copyTokenToClipboard(publicTokenInput, publicCopyIcon);
    });
  }

  // --- 2. API Secret Token Logic ---

  // Secret Token Elements
  const secretTokenInput = document.getElementById("api-secret-token-input");
  const secretVisibilityIcon = document.getElementById(
    "secret-visibility-toggle-icon"
  );
  const secretCopyIcon = document.getElementById("secret-copy-icon");

  if (secretTokenInput && secretVisibilityIcon && secretCopyIcon) {
    // Visibility Toggle
    secretVisibilityIcon.addEventListener("click", () => {
      if (secretTokenInput.type === "password") {
        secretTokenInput.type = "text";
        secretVisibilityIcon.classList.remove("fa-eye");
        secretVisibilityIcon.classList.add("fa-eye-slash");
      } else {
        secretTokenInput.type = "password";
        secretVisibilityIcon.classList.remove("fa-eye-slash");
        secretVisibilityIcon.classList.add("fa-eye");
      }
    });

    // Copy Logic
    secretCopyIcon.addEventListener("click", async () => {
      await copyTokenToClipboard(secretTokenInput, secretCopyIcon);
    });
  }

  // --- Shared Helper Function for Copy Logic (Keeps code DRY) ---

  async function copyTokenToClipboard(inputElement, iconElement) {
    const tokenValue = inputElement.value;
    const originalIcon = iconElement.querySelector("i");

    try {
      await navigator.clipboard.writeText(tokenValue);

      // Visual feedback: checkmark
      originalIcon.classList.remove("fa-copy", "text-gray-500");
      originalIcon.classList.add("fa-check", "text-green-500");

      // Reset icon
      setTimeout(() => {
        originalIcon.classList.remove("fa-check", "text-green-500");
        originalIcon.classList.add("fa-copy", "text-gray-500");
      }, 1500);
    } catch (err) {
      console.error("Failed to copy token:", err);
      // Fallback
      inputElement.select();
      document.execCommand("copy");
    }
  }

  // API Documentation

  const tabsContainer = document.getElementById("code-tabs");
  const tabs = document.querySelectorAll(".tab-button");
  const contents = document.querySelectorAll(".tab-content");
  const copyButton = document.getElementById("copy-code-btn");

  let activeTabId = "curl"; // Default active tab

  // --- Tab Switching Logic ---
  function switchTab(targetId) {
    activeTabId = targetId;

    tabs.forEach((tab) => {
      const isActive = tab.dataset.tab === targetId;
      tab.classList.toggle("border-blue-500", isActive);
      tab.classList.toggle("bg-gray-50", isActive);
      tab.classList.toggle("text-gray-800", isActive);
      tab.classList.toggle("bg-transparent", !isActive);
      tab.classList.toggle("border-transparent", !isActive);
    });

    contents.forEach((content) => {
      const isVisible = content.dataset.content === targetId;
      content.classList.toggle("hidden", !isVisible);
    });
  }

  tabsContainer?.addEventListener("click", (e) => {
    const targetButton = e.target.closest(".tab-button");
    if (targetButton) {
      const targetId = targetButton.dataset.tab;
      switchTab(targetId);
    }
  });

  // Initialize the first tab appearance
  const initialTab = document.querySelector(
    `.tab-button[data-tab="${activeTabId}"]`
  );
  if (initialTab) {
    initialTab.classList.add("border-blue-500", "bg-gray-50", "text-gray-800");
    initialTab.classList.remove("border-transparent", "bg-transparent");
  }

  // --- Copy Code Logic ---
  copyButton?.addEventListener("click", async () => {
    // Find the code block of the currently active tab
    const activeContent = document.querySelector(
      `.tab-content[data-content="${activeTabId}"] code`
    );

    if (activeContent) {
      const codeToCopy = activeContent.innerText;

      try {
        await navigator.clipboard.writeText(codeToCopy.trim());

        // Provide visual feedback
        const copyIcon = copyButton.querySelector("i");
        copyIcon.classList.remove("fa-copy");
        copyIcon.classList.add("fa-check", "text-green-400");

        setTimeout(() => {
          copyIcon.classList.remove("fa-check", "text-green-400");
          copyIcon.classList.add("fa-copy");
        }, 1500);
      } catch (err) {
        console.error("Failed to copy code: ", err);
      }
    }
  });

  const avatarUpload = document.getElementById("avatar-upload");
  const profileAvatar = document.getElementById("profile-avatar");
  const changeImageBtn = document.getElementById("change-image-btn");
  const removeImageBtn = document.getElementById("remove-image-btn");

  // Trigger file input when "Change Image" button is clicked
  changeImageBtn?.addEventListener("click", () => {
    avatarUpload?.click();
  });

  // Handle image preview when a file is selected
  avatarUpload?.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        if (profileAvatar) {
          profileAvatar.src = e.target.result;
        }
      };
      reader.readAsDataURL(file);
    }
  });

  // Remove image logic
  removeImageBtn?.addEventListener("click", () => {
    if (profileAvatar) {
      profileAvatar.src = "https://via.placeholder.com/96"; // Reset to a default placeholder
      avatarUpload.value = ""; // Clear the file input
      alert(
        "Profile image removed (visually, refresh to see old image if not saved)"
      );
    }
  });

  // --- First Name / Last Name Edit Logic ---
  const firstNameInput = document.getElementById("first-name");
  const lastNameInput = document.getElementById("last-name");
  const editNameBtn = document.getElementById("edit-name-btn");
  const nameEditActions = document.getElementById("name-edit-actions");
  const saveNameBtn = document.getElementById("save-name-btn");
  const cancelNameEditBtn = document.getElementById("cancel-name-edit-btn");

  let originalFirstName = firstNameInput?.value;
  let originalLastName = lastNameInput?.value;

  function enableEditMode() {
    if (firstNameInput) {
      firstNameInput.readOnly = false;
      firstNameInput.classList.remove("bg-gray-50");
      firstNameInput.classList.add("bg-white");
      firstNameInput.focus();
    }
    if (lastNameInput) {
      lastNameInput.readOnly = false;
      lastNameInput.classList.remove("bg-gray-50");
      lastNameInput.classList.add("bg-white");
    }
    if (editNameBtn) editNameBtn.classList.add("hidden");
    if (nameEditActions) nameEditActions.classList.remove("hidden");
  }

  function disableEditMode() {
    if (firstNameInput) {
      firstNameInput.readOnly = true;
      firstNameInput.classList.add("bg-gray-50");
      firstNameInput.classList.remove("bg-white");
    }
    if (lastNameInput) {
      lastNameInput.readOnly = true;
      lastNameInput.classList.add("bg-gray-50");
      lastNameInput.classList.remove("bg-white");
    }
    if (editNameBtn) editNameBtn.classList.remove("hidden");
    if (nameEditActions) nameEditActions.classList.add("hidden");
  }

  // "Edit" button click
  editNameBtn?.addEventListener("click", () => {
    originalFirstName = firstNameInput?.value; // Store current values
    originalLastName = lastNameInput?.value;
    enableEditMode();
  });

  // "Save" button click
  saveNameBtn?.addEventListener("click", () => {
    // In a real application, you'd send an AJAX request here to save the new names.
    // For this example, we'll just disable edit mode.
    alert(
      `Saved: First Name - ${firstNameInput.value}, Last Name - ${lastNameInput.value}`
    );
    disableEditMode();
  });

  // "Cancel" button click
  cancelNameEditBtn?.addEventListener("click", () => {
    if (firstNameInput) firstNameInput.value = originalFirstName; // Revert to original values
    if (lastNameInput) lastNameInput.value = originalLastName;
    disableEditMode();
  });

  // --- Other Button Placeholders (Add your specific logic here) ---
  document.querySelectorAll("button").forEach((button) => {
    if (
      ![
        "edit-name-btn",
        "save-name-btn",
        "cancel-name-edit-btn",
        "change-image-btn",
        "remove-image-btn",
      ].includes(button.id)
    ) {
      button.addEventListener("click", () => {
        // console.log(`Button clicked: ${button.textContent.trim()}`);
        // Example: if (button.textContent.includes('Log Out')) { /* perform logout */ }
      });
    }
  });

  Highcharts?.chart("container", {
    chart: {
      type: "column",
    },
    title: {
      text: "Total SMS sent over a period ",
    },
    // subtitle: {
    //   text:
    //     'Source: <a target="_blank" ' +
    //     'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
    // },
    xAxis: {
      categories: [
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
      ],
      crosshair: true,
      accessibility: {
        description: "Months",
      },
    },
    yAxis: {
      min: 0,
      title: {
        text: "Total SMS Sent",
      },
    },
    tooltip: {
      valueSuffix: " (1000 SMS)",
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0,
      },
    },
    series: [
      {
        name: "Sent SMS",
        data: [387749, 280000, 129000, 64300, 54000, 34300],
      },
      {
        name: "Scheduled",
        data: [45321, 140000, 10000, 140500, 19500, 113500],
      },
    ],
  });

  function flashMessage(type, content) {
  // Clear any previous alerts
  $('.alert-msg').empty();

  // Define Tailwind color classes for each type
  const alertClasses = {
    success: 'bg-green-100 text-green-600 ring-green-400',
    danger: 'bg-red-100 text-red-600 ring-red-400',
    warning: 'bg-yellow-100 text-yellow-700 ring-yellow-400',
    info: 'bg-blue-100 text-blue-600 ring-blue-400',
  };

  // Get appropriate color scheme or default to info
  const color = alertClasses[type] || alertClasses.info;

  // Create alert HTML
  const alertHtml = `
    <div
      class="alert fixed top-4 left-1/2 transform -translate-x-1/2 z-50 flex items-center px-4 py-3 mb-4 min-h-16 rounded-lg shadow-lg w-11/12 md:w-7/12 ${color} transition-all duration-300 ease-in-out animate-slideDown"
      role="alert"
    >
      <svg class="shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
      </svg>
      <div class="ms-3 text-sm font-medium">${content}</div>
      <button
        type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white/30 text-current rounded-lg focus:ring-2 focus:ring-offset-1 p-1.5 hover:bg-white/40 inline-flex items-center justify-center h-8 w-8 transition"
        aria-label="Close"
        onclick="$(this).closest('.alert').fadeOut(200, function(){ $(this).remove(); })"
      >
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>
    </div>
  `;

  // Append to container
  $('.alert-msg').append(alertHtml);
}





// });
