$(document).ready(function () {
    // api read
    $.ajax({
        type: "GET",
        url: host + "read_obat.php",
        dataType: "json",
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            var dataObat = data.body.data;
            for (var i = 0; i < dataObat.length; i++) {
                $("#obatTable").append(
                    `
                    <tr>
                        <td>` +
                        (i + 1) +
                        `</td>
                        <td>` +
                        dataObat[i].kode +
                        `</td>
                        <td>` +
                        dataObat[i].obat +
                        `</td>
                        <td>` +
                        dataObat[i].kategori +
                        `</td>
                        <td>
                        <img src="../assets/img/` +
                        dataObat[i].gambar +
                        `" width="100" />
                        </td>
                        <td>
                        <button id="hapus" class="btn btn-danger" value="` +
                        dataObat[i].kode +
                        `">Hapus
                        </button>
                        <button id="edit" class="btn btn-primary">
                            <a class="text-light" href="../obat_edit/obat_edit.html?kode=` +
                        dataObat[i].kode +
                        `">Edit</a>
                            </button>
                        </td>
                    </tr>
                    `
                );
            }
        },
    });

    // api hapus
    $(document).on("click", "#hapus", function () {
        var kode = $(this).val();

        if (confirm("Yakin ingin hapus data dengan kode=" + kode + "?")) {
            $.ajax({
                type: "POST",
                url: host + "delete_obat.php",
                data: { kode: kode },
                dataType: "json",
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert(response.msg);
                },
            });
        }
    });
});
