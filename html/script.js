// script.js

// Function to fetch questions
async function getQuestions() {
    try {
        const response = await fetch('get_questions.php');
        const questions = await response.json();
        const questionsContainer = document.getElementById('questionsContainer');
        questionsContainer.innerHTML = ''; // Clear any existing content
        // Generate HTML for each question
        questions.forEach(question => {
            const questionCard = createQuestionCard(question);
            questionsContainer.appendChild(questionCard);
        });
    } catch (error) {
        console.error('Error fetching questions:', error);
    }
}

// Call the function to fetch questions on page load
getQuestions();

// Function to search through questions
function searchQuestions() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.toLowerCase();
    const questionsContainer = document.getElementById('questionsContainer');
    const questions = questionsContainer.querySelectorAll('.question-card');
    questions.forEach(question => {
        const questionText = question.querySelector('.card-title').innerText.toLowerCase();
        if (questionText.includes(searchTerm)) {
            question.style.display = 'block'; // Show matching questions
        } else {
            question.style.display = 'none'; // Hide non-matching questions
        }
    });
}

// Function to create HTML for a question card
function createQuestionCard(question) {
    const card = document.createElement('div');
    card.classList.add('col-md-4', 'mb-3', 'question-card');
    card.innerHTML = `
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">${question.question}</h5>
                <img src="${question.image}" class="card-img-top" alt="Image">
                <p class="card-text card-answer">${question.answer}</p>
            </div>
        </div>
    `;
    return card;
}