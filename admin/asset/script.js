
$(document).ready(function() {
    // Menampilkan box dengan efek slide saat halaman selesai dimuat
    $(".notification-box").slideDown("slow");

    // Menyembunyikan box saat tombol "Close" diklik
    $(".close-button").click(function() {
        $(".notification-box").slideUp("slow");
    });
});