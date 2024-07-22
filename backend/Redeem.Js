const apiUrl = "../backend/reward.php"; // Update the API URL to point to your PHP script

// Function to get points data (inbuilt points)
function getPointsData() {
  accumulatedPoints = 100; // inbuilt accumulated points
  redeemedPoints = 10; // inbuilt redeemed points
  document.getElementById("accumulated-points").textContent = accumulatedPoints;
  document.getElementById("redeemed-points").textContent = redeemedPoints;
}

// Function to update points values
function updatePoints() {
  document.getElementById("accumulated-points").innerText = accumulatedPoints;
  document.getElementById("redeemed-points").innerText = redeemedPoints;
}

// Function to get prize data and display date left
function getPrizeDataAndDisplayDateLeft() {
  fetch(`${apiUrl}?action=getPrizeData`)
    .then((response) => response.json())
    .then((prizeData) => {
      prizeData.forEach((prize, index) => {
        const currentDate = new Date();
        const endDate = new Date(prize.End_date);
        const dateLeft = Math.floor(
          (endDate - currentDate) / (1000 * 60 * 60 * 24)
        );
        document.getElementById(
          `date-left-${index + 1}`
        ).textContent = `${dateLeft} days`;
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Call getPrizeDataAndDisplayDateLeft when the page loads
getPrizeDataAndDisplayDateLeft();

let prizeExpired = []; // Add an array to track expired prizes

function redeemPoints(rewardId, pointValue) {
  return fetch(`${apiUrl}?action=getPrizeData`)
    .then((response) => response.json())
    .then((prizeData) => {
      const currentDate = new Date();
      const endDate = new Date(prizeData[rewardId - 1].End_date);
      if (endDate < currentDate) {
        // Prize has expired, reject the promise
        return Promise.reject(new Error("Prize has expired"));
      } else {
        // Prize is still viable, redeem points
        accumulatedPoints -= pointValue;
        redeemedPoints += pointValue;
        updatePoints();
        return Promise.resolve(); // Resolve the promise
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Prize has expired");
      return Promise.reject(error); // Reject the promise
    });
}

// Add event listeners to redeem buttons
const redeemButtons = document.querySelectorAll(".btn"); // Select buttons using class name
redeemButtons.forEach((redeemButton, index) => {
  let isValid = true; // Add a flag to track whether the button is in a valid state
  let isClicked = false; // Add a flag to track whether the button has been clicked
  redeemButton.addEventListener("click", () => {
    if (isValid && !isClicked) {
      const pointValue = parseInt(
        document.querySelectorAll(".top-right")[index].textContent
      );
      const rewardId = index + 1; // Assuming rewardId is the index + 1
      if (prizeExpired[rewardId - 1]) {
        // Prize has expired, alert and return
        alert("Prize has expired");
        return;
      }
      if (accumulatedPoints >= pointValue) {
        isValid = false; // Set isValid to false while redeeming points
        redeemPoints(rewardId, pointValue)
          .then(() => {
            isClicked = true; // Set the flag to true after the button is clicked
            redeemButton.disabled = true; // Disable the button after it's been clicked
            redeemButton.style.backgroundColor = "#ccc"; // Change the button's background color
            redeemButton.style.color = "#666"; // Change the button's text color
            redeemButton.style.cursor = "not-allowed"; // Change the cursor to indicate it's disabled
          })
          .catch((error) => {
            console.error("Error:", error);
            isValid = true; // Set isValid back to true on error
          });
      } else {
        alert("Not enough points");
      }
    } else if (!isValid) {
      alert("Please wait for the previous redemption to complete");
    } else {
      alert("You've already redeemed this reward");
    }
  });
});

getPointsData();

getPointsData();
