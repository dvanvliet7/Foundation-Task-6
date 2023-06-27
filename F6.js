// function generateAllPeople() {
//     fetch('http://localhost:3000/foundation_tasks/task(6)/person_class.php')
//         .then(response => response.text())
//         .then(data => document.getElementById("bodyTable").innerHTML = data)
//         .catch(err => console.error(err));
// }

function loadAllPeople() {
    fetch('http://localhost:3000/foundation_tasks/task(6)/person_class.php')
        .then(response => response.text)
        .then(data => document.getElementById("bodyTable").innerHTML = data)
        .catch(err => console.error(err));
}

function createTableFromObjects(data) {
    table = document.createElement('table');
    headerRow = document.createElement('tr');
    
    // Create table header row
    keys = Object.keys(data[0]);
    for (key of keys) {
        headerCell = document.createElement('th');
        headerCell.textContent = key;
        headerRow.appendChild(headerCell);
    }
    table.appendChild(headerRow);

    // Create table data rows
    for (obj of data) {
        dataRow = document.createElement('tr');
        for (key of keys) {
            dataCell = document.createElement('td');
            dataCell.textContent = obj[key];
            dataRow.appendChild(dataCell);
        }
        table.appendChild(dataRow);
    }

    return table;
    }


    dataArray = [
        {"FirstNameStr":"Stan","SurNameStr":"White","DateOfBirthStr":"1998-02-11","EmailAddressStr":"white@gmail.com","AgeInt":25},
        {"FirstNameStr":"Greg","SurNameStr":"Smith","DateOfBirthStr":"1988-10-07","EmailAddressStr":"gsmith@gmail.com","AgeInt":35},
        {"FirstNameStr":"Adam","SurNameStr":"Steyn","DateOfBirthStr":"1993-01-31","EmailAddressStr":"asteyn@gmail.com","AgeInt":30},
        {"FirstNameStr":"Michael","SurNameStr":"Lester","DateOfBirthStr":"1997-08-21","EmailAddressStr":"lester@gmail.com","AgeInt":26},
        {"FirstNameStr":"Luke","SurNameStr":"Peterson","DateOfBirthStr":"1999-04-10","EmailAddressStr":"luke@gmail.com","AgeInt":24},
        {"FirstNameStr":"Ryan","SurNameStr":"Reynolds","DateOfBirthStr":"1992-03-09","EmailAddressStr":"ryan@gmail.com","AgeInt":31},
        {"FirstNameStr":"Chris","SurNameStr":"Rock","DateOfBirthStr":"2000-03-28","EmailAddressStr":"rock@gmail.com","AgeInt":23},
        {"FirstNameStr":"Matthew","SurNameStr":"Walsh","DateOfBirthStr":"2002-02-06","EmailAddressStr":"walsh@gmail.com","AgeInt":21},
        {"FirstNameStr":"Sinclair","SurNameStr":"Ferguson","DateOfBirthStr":"1987-11-16","EmailAddressStr":"fer@gmail.com","AgeInt":36},
        {"FirstNameStr":"Rory","SurNameStr":"Lapham","DateOfBirthStr":"1969-06-30","EmailAddressStr":"lapham@gmail.com","AgeInt":54},
        {"FirstNameStr":"James","SurNameStr":"Brown","DateOfBirthStr":"1963-08-02","EmailAddressStr":"hsbuhvsbh@example.com","AgeInt":55}
    ];

    table = createTableFromObjects(dataArray);

    tableContainer = document.getElementById('bodyTable');
    tableContainer.appendChild(table);