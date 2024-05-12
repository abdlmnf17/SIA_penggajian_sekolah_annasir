document.addEventListener('DOMContentLoaded', function () {
    // Find the success alert element
    const successAlert = document.querySelector('.alert-success');

    // If success alert element exists
    if (successAlert) {
        // Set a timeout to remove the alert after 4 seconds
        setTimeout(function () {
            successAlert.remove();
        }, 4000); // 4000 milliseconds = 4 seconds
    }
});

function confirmDelete() {
    let confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");

    if (confirmation) {
      // If user confirms, submit the form
      document.querySelector('form').submit();
    } else {
      // If user cancels, do nothing
      return false;
    }
  }



    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ ",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                },
                "oAria": {
                    "sSortAscending": ": aktifkan untuk mengurutkan kolom secara ascending",
                    "sSortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                }
            }
        });
    });


    $(document).ready(function() {
        // Select/Deselect all checkboxes
        $("#select-all").change(function() {
            $("input[name='selected_guru[]']").prop('checked', $(this).prop("checked"));
        });

        // Handle delete selected
        $("#deleteSelected").click(function() {
            // Periksa apakah ada guru yang dipilih
            if ($("input[name='selected_guru[]']:checked").length > 0) {
                // Tampilkan modal konfirmasi
                $("#confirmDeleteModal").modal('show');
            } else {
                alert("Tidak ada guru yang dipilih!");
            }
        });

        // Handle konfirmasi hapus
        $("#confirmDeleteButton").click(function() {
            $("#deleteForm").submit();
        });
    });


    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('preview');
          output.src = reader.result;
          output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
      }

      function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('preview');
          output.src = reader.result;
          output.style.display = 'block';
          var profilePhotoPreview = document.getElementById('profile_photo_preview');
          if (profilePhotoPreview) {
            profilePhotoPreview.style.display = 'none';
          }
        }
        reader.readAsDataURL(event.target.files[0]);
      }

