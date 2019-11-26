const employees = document.getElementById("employees");
if (employees){
    employees.addEventListener('click', e => {
        if (e.target.className === 'btn btn-primary active'){
            if (confirm('Do you want to delete this record?')){
                const id = e.target.getAttribute('data-id');
                fetch(`/employee/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}