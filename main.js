const aboutMe = function() {
    const section = document.createElement('div');
    const title = document.createElement('h1');
    var paragraphs = [];
    const content = [
        'I started working in web development in November of 2018. I fell in love with it immediately. While I was in school, I changed my major time and time again. I had a very difficult time deciding what I wanted to do for the rest of my life. Working in web development was the best thing that could’ve happened to me when it did.',
        
        'Coding is something that really makes sense to me. The math and the logic just click in my mind. I love the variety of challenges that I get to solve every day. I love being able to find multiple solutions to the same problem, eventually coming to the best solution for the particular problem. I am very happy to be working in the field, and my dream is to contribute to the field in a major way some day.'
    ];

    title.textContent = 'About Me';
    document.title = 'General Trom | About Me';

    for(text of content) {
        let paragraph = document.createElement('p');
        paragraph.textContent = text;
        paragraphs.push(paragraph);
    }

    section.id = 'about-me-section';
    section.classList.add('slideInLeft');
    section.appendChild(title);
    for(p of paragraphs) {
        section.appendChild(p);
    }

    return section;
}

function renderSection(newSection, currentSection) {
    var container = document.getElementById('main-container');
    currentSection = document.getElementById(currentSection);

    currentSection.classList.add('slideOutLeft');
    container.appendChild(newSection);
    setTimeout(() => {
        currentSection.remove();
        newSection.classList.remove('slideInLeft');
    }, 500);
}

