jQuery(document).ready(function ($) {
  "use strict";

  if ($("table.first").length) {
    $(document).ready(function () {
      $("table.first").DataTable();
    });
  }

  /* Calender jQuery **/

  if ($("table.second").length) {
    $(document).ready(function () {
      var table = $("table.second").DataTable({
        order: [[5, "asc"]], //@denzil: this is where I order by the 5th column
        lengthChange: false,
        buttons: [
          {
            extend: "copyHtml5", //@denzil: I'm setting the columns to get exported here
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6],
            },
          },
          {
            extend: "excelHtml5",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6],
            },
          },
          {
            extend: "pdfHtml5",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6],
            },
          },
          "colvis",
        ],
      });

      table.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
    });
  }

  if ($("#example2").length) {
    $(document).ready(function () {
      $(document).ready(function () {
        var groupColumn = 2;
        var table = $("#example2").DataTable({
          columnDefs: [{ visible: false, targets: groupColumn }],
          order: [[groupColumn, "asc"]],
          displayLength: 25,
          drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            api
              .column(groupColumn, { page: "current" })
              .data()
              .each(function (group, i) {
                if (last !== group) {
                  $(rows)
                    .eq(i)
                    .before(
                      '<tr class="group"><td colspan="5">' +
                        group +
                        "</td></tr>"
                    );

                  last = group;
                }
              });
          },
        });

        // Order by the grouping
        $("#example2 tbody").on("click", "tr.group", function () {
          var currentOrder = table.order()[0];
          if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
          } else {
            table.order([groupColumn, "asc"]).draw();
          }
        });
      });
    });
  }

  if ($("#example3").length) {
    $("#example3").DataTable({
      select: {
        style: "multi",
      },
    });
  }
  if ($("#example4").length) {
    $(document).ready(function () {
      var table = $("#example4").DataTable({
        fixedHeader: true,
      });
    });
  }
});
