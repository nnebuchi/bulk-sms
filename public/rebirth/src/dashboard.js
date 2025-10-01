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


// });
