const coursesTable = document.getElementById('courses-table');

// console.log(coursesTable)

document.getElementById('download-admit').addEventListener('click', function () {
    domtoimage.toPng(coursesTable).then(data => {
        const a_tag = document.createElement('a');
        a_tag.download = 'my-admit.png';
        a_tag.href = data;
        a_tag.click();
    })
});


