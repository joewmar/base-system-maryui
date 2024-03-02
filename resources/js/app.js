import './bootstrap';
import Swal from 'sweetalert2'

window.Swal = Swal

document.getElementById('year').textContent = new Date().getFullYear();
