// Define the Card function
function Card(record) {
  const card = document.createElement("div");
  card.className = "card";

  // Add image
  const img = document.createElement("img");
  img.src = `../BookCover/${record.image_link}`;
  img.alt = `Card ${record.idbook_card}`;
  card.appendChild(img);

  // Add card info
  const cardInfo = document.createElement("div");
  cardInfo.className = "card-info";
  card.appendChild(cardInfo);

  // Add book details
  const bookDetails = document.createElement("div");
  bookDetails.className = "book-details";
  cardInfo.appendChild(bookDetails);

  // Add title
  const title = document.createElement("h2");
  title.textContent = `Title: ${record.Title}`;
  console.log(record.Title);
  bookDetails.appendChild(title);

  // Add author
  const author = document.createElement("p");
  author.textContent = `Author: ${record.Author}`;
  bookDetails.appendChild(author);

  // Add genre
  const genre = document.createElement("p");
  genre.textContent = `Genre: ${record.Genre}`;
  bookDetails.appendChild(genre);

  // Add donor
  const donor = document.createElement("p");
  donor.textContent = `Donor: ${record.Donor}`;
  console.log(record.Title);
  bookDetails.appendChild(donor);

  // Add button container
  const buttonContainer = document.createElement("div");
  buttonContainer.className = "button-container";
  cardInfo.appendChild(buttonContainer);

  // Add view button
  const viewButton = document.createElement("button");
  viewButton.className = "btn";
  viewButton.textContent = "View";
  buttonContainer.appendChild(viewButton);

  // Add edit button
  const editButton = document.createElement("button");
  editButton.className = "btn";
  editButton.textContent = "Add to Cart";
  buttonContainer.appendChild(editButton);

  return card;
}

// Handle search form submission
document.getElementById("search-form").addEventListener("submit", (e) => {
  e.preventDefault();
  const searchTerm = document.getElementById("search-input").value;
  fetch(`../backend/SearchList.php?term=${searchTerm}`) // Update: use correct URL
    .then((response) => response.json())
    .then((data) => {
      console.log("test");
      // Clear previous results
      document.getElementById("divList").innerHTML = "";

      // Create a card for each book in the data
      data.forEach((record) => {
        console.log(record);
        const card = Card(record);
        document.getElementById("divList").appendChild(card);
      });
    })
    .catch((error) => console.error("Error:", error));
});
