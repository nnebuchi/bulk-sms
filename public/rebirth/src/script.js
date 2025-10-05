// public/accordion.js

document.addEventListener("DOMContentLoaded", () => {
  const accordionItems = document.querySelectorAll(".accordion-item");

  accordionItems.forEach((item) => {
    const header = item.querySelector(".accordion-header");

    header.addEventListener("click", () => {
      const content = item.querySelector(".accordion-content");
      const icon = item.querySelector(".accordion-icon");
      const isOpen =
        content.style.maxHeight && content.style.maxHeight !== "0px";

      // First, close all other accordion items
      accordionItems.forEach((otherItem) => {
        if (otherItem !== item) {
          const otherContent = otherItem.querySelector(".accordion-content");
          const otherIcon = otherItem.querySelector(".accordion-icon");
          otherContent.style.maxHeight = "0px";
          otherIcon.style.transform = "rotate(0deg)";
        }
      });

      // Then, toggle the clicked item
      if (isOpen) {
        content.style.maxHeight = "0px";
        icon.style.transform = "rotate(0deg)";
      } else {
        // The scrollHeight property returns the height of an element's content
        content.style.maxHeight = content.scrollHeight + "px";
        icon.style.transform = "rotate(45deg)";
      }
    });
  });

  // Get the mobile menu element
  const mobileMenu = document.getElementById("mobile-menu");

  // Get the close menu button
  const closeMenuButton = document.getElementById("close-menu");

  // Get the menu button (assuming it's a separate element)
  const menuButton = document.getElementById("menu-trigger"); // Replace with the actual ID of your menu button

  // Add event listener to the menu button to show the mobile menu
  menuButton.addEventListener("click", () => {
    console.log("Menu button clicked");
    mobileMenu.classList.replace("hidden", "flex");
    mobileMenu.classList.add("slide-down");
    mobileMenu.classList.remove("slide-up");
  });

  // Add event listener to the close menu button to hide the mobile menu
  closeMenuButton.addEventListener("click", () => {
    console.log("Close menu button clicked");
    mobileMenu.classList.add("slide-up");
    mobileMenu.classList.remove("slide-down");
    setTimeout(() => {
      mobileMenu.classList.replace("flex", "hidden");
    }, 400);
  });

  // Add transition effect to the mobile menu
  mobileMenu.addEventListener("transitionend", () => {
    if (mobileMenu.classList.contains("slide-up")) {
      mobileMenu.style.display = "none";
    }
  });

  // Password Visibility
  const passwordInput = document.getElementById("password");
  const passwordVisibility = document.getElementById("password-visibility");

  passwordVisibility?.addEventListener("click", () => {
    console.log("clicked");
    if (passwordInput?.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
    if (passwordVisibility?.classList.contains("fa-eye-slash")) {
      passwordVisibility?.classList.replace("fa-eye-slash", "fa-eye");
    } else {
      passwordVisibility?.classList.replace("fa-eye", "fa-eye-slash");
    }
  });

  // Calculator

  const amountEntered = document.getElementById("amount");
  const smsQuantity = document.getElementById("quantity");
  const totalAmount = document.getElementById("total");

  amountEntered?.addEventListener("input", () => {
    const unitCostValue = 5;
    const value = amountEntered.value;
    smsQuantity.textContent = value.toLocaleString("en-US");

    // totalAmount.textContent = "₦" + unitCostValue * smsQuantity.textContent;
    totalAmount.textContent =
      "₦" + (unitCostValue * smsQuantity.textContent).toLocaleString("en-US");
  });
});
