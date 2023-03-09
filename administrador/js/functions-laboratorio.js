$('#tablelaboratorios').DataTable();
var tablelaboratorios;

document.addEventListener('DOMContentLoaded',function(){
    tablelaboratorios = $('#tablelaboratorios').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": "./models/laboratorios/table_laboratorios.php",
            "dataSrc":""
        },
        "columns": [
            {"data":"acciones"},
            {"data":"id"},
            {"data":"titulo"},
            {"data":"descripcion"},
            {"data":"codigo"},
            {"data":"materia_id"},
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });

    var formAula = document.querySelector('#formLaboratorio');
    formAula.onsubmit = function(e) {
        e.preventDefault();

        var idlaboratorio = document.querySelector('#idlaboratorio').value;
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var codigo= document.querySelector('#codigo').value;
        var listMateria= document.querySelector('#listMateria').value;
        if(titulo == '') {
            swal('Atencion','Todos los campos son necesarios','error');
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/laboratorios/ajax-Laboratorios.php';
        var form = new FormData(formLaboratorio);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    $('#modalLaboratorio').modal('hide');
                    formLaboratorio.reset();
                    swal('Laboratorio',data.msg,'success');
                    tablelaboratorios.ajax.reload();
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
    }
})

function openModalAu() {
    document.querySelector('#idaula').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nueva Aula';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAula').reset();
    $('#modalAula').modal('show');
}

function editarAula(id) {
    var idaula = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Grado';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/aulas/edit-aula.php?idaula='+idaula;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if(data.status) {
                    document.querySelector('#idaula').value = data.data.aula_id;
                    document.querySelector('#nombre').value = data.data.nombre_aula;
                    document.querySelector('#listEstado').value = data.data.estado;

                    $('#modalAula').modal('show');
                } else {
                    swal('Atencion',data.msg,'error');
                }
            }
        }
}

function eliminarAula(id) {
    var idaula = id;

    swal({
        title: "Eliminar Aula",
        text: "Realmente desea eliminar el aula?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    },function(confirm){
        if(confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/aulas/delet-aula.php';
            request.open('POST',url,true);
            var strData = "idaula="+idaula;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if(data.status) {
                        swal('Eliminar',data.msg,'success');
                        tableaulas.ajax.reload();
                    } else {
                        swal('Atencion',data.msg,'error');
                    }
                }
            }
        }
    })
}