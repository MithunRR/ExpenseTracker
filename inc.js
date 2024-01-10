
add_income

close_form

function openForm (){
    let btnO = document.getElementById('add_income');
    if (btnO.style.display === 'none') {
        btnO.style.display = 'block';
      } 
    else {
        btnO.style.display = 'none';
    }

}