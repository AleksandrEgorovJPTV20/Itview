<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Турниры</title>
<link rel="stylesheet" href="public/css/index.css">
</head>
<body>

    
<!-- Пример HTML-кода для списка категорий спорта и турниров -->
<div id="sport-categories">
    <!-- Картинки для выбора категории -->
    <img src="images/football_icon.png" alt="Футбол" data-category="Футбол">
    <img src="images/tennis_icon.png" alt="Теннис" data-category="Теннис">
    <img src="images/snooker_icon.png" alt="Снукер" data-category="Снукер">
    <img src="images/basketball_icon.png" alt="Баскетбол" data-category="Баскетбол">
    <img src="images/chess_icon.png" alt="Шахматы" data-category="Шахматы">
    <img src="images/ice_hockey_icon.png" alt="Хоккей" data-category="Хоккей">
</div>

<ul id="tournament-list"></ul>
<ul id="match-results"></ul>

<!-- JavaScript-код -->
<script>
    // Пример данных с турнирами для каждой категории
const tournamentsData = {
'Футбол': ['Лига Чемпионов', 'Чемпионат Европы', 'Английская Премьер-Лига', 'Испанская Ла Лига', 'Итальянская Серия А'],
'Теннис': ['Турнир A', 'Турнир B', 'Турнир C', 'Турнир D', 'Турнир E'],
'Бильярд': ['Турнир X', 'Турнир Y', 'Турнир Z', 'Турнир P', 'Турнир Q'],
'Баскетбол': ['Турнир Alpha', 'Турнир Beta', 'Турнир Gamma', 'Турнир Delta', 'Турнир Epsilon'],
'Шахматы': ['Турнир I', 'Турнир II', 'Турнир III', 'Турнир IV', 'Турнир V'],
'Хоккей': ['Турнир I', 'Турнир II', 'Турнир III', 'Турнир IV', 'Турнир V'],
};

// Пример данных с результатами матчей для каждого турнира
const matchResults = {
'Лига Чемпионов': ['1:0', '2:1', '3:2', '4:0', '2:2'],
'Чемпионат Европы': ['3:1', '0:0', '2:3', '1:0', '4:2'],
'Английская Премьер-Лига': ['2:0', '1:1', '3:3', '0:1', '2:1'],
'Испанская Ла Лига': ['6:4', '3:2', '1:1', '5:3', '2:0'],
'Итальянская Серия А': ['50:30', '40:25', '35:45', '55:20', '60:55'],
// Добавьте результаты для остальных турниров
};

function showTournaments(sport) {
    const tournaments = tournamentsData[sport];
    alert(`Турниры по ${sport}: ${tournaments.join(', ')}`);
}

function updateMatchResults(tournament, results) {
const resultsList = document.getElementById('match-results');
resultsList.innerHTML = '';

if (results.length === 0) {
const noResultsItem = document.createElement('li');
noResultsItem.textContent = 'Результаты отсутствуют';
resultsList.appendChild(noResultsItem);
} else {
results.forEach(result => {
const resultItem = document.createElement('li');
resultItem.textContent = `${tournament}: ${result}`;
resultsList.appendChild(resultItem);
});
}
}

function updateTournaments(category) {
const tournamentList = document.getElementById('tournament-list');
tournamentList.innerHTML = '';

const tournaments = tournamentsData[category] || [];

tournaments.forEach(tournament => {
const listItem = document.createElement('li');
listItem.textContent = tournament;

listItem.addEventListener('click', () => {
const previousSelected = document.querySelector('.selected');
if (previousSelected) {
previousSelected.classList.remove('selected');
}

listItem.classList.add('selected');
updateMatchResults(tournament, matchResults[tournament] || []);
});

tournamentList.appendChild(listItem);
});

updateMatchResults('', []);
}
      function updateTournaments(category) {
        const tournamentList = document.getElementById('tournament-list');
        tournamentList.innerHTML = '';

        const tournaments = tournamentsData[category] || [];

        tournaments.forEach(tournament => {
            const listItem = document.createElement('li');
            listItem.textContent = tournament;
            listItem.setAttribute('data-tournament', tournament);

            listItem.addEventListener('click', () => {
                const previousSelected = document.querySelector('.selected-tournament');
                if (previousSelected) {
                    previousSelected.classList.remove('selected-tournament');
                }

                listItem.classList.add('selected-tournament');
                const selectedTournament = listItem.getAttribute('data-tournament');
                updateMatchResults(selectedTournament, matchResults[selectedTournament] || []);
            });

            tournamentList.appendChild(listItem);
        });

        updateMatchResults('', []);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const sportCategoriesList = document.getElementById('sport-categories');
        sportCategoriesList.addEventListener('click', function (event) {
            const selectedCategory = event.target.getAttribute('data-category');
            if (selectedCategory) {
                updateTournaments(selectedCategory);
            }
        });
    });
</script>


</body>
</html>

<?php
    $content = ob_get_clean();
    include "view/templates/layout.php";
?>