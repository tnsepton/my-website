const aboutMe = function() {
    const section = document.createElement('div');
    const title = document.createElement('h1');
    var paragraphs = [];
    const content = [
        'alsdjflkajsldkfjasdk',
        'lakdjflkajsdfklajsdflkj'
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

