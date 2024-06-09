-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2024 pada 05.03
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkonser`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `konser`
--

CREATE TABLE `konser` (
  `id` int(11) NOT NULL,
  `nama_artis` varchar(255) NOT NULL,
  `nama_konser` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `waktu_konser` date NOT NULL,
  `jam_konser` time NOT NULL,
  `stock_supervip` int(11) NOT NULL,
  `stock_vip` int(11) NOT NULL,
  `stock_reguler` int(11) NOT NULL,
  `harga_reguler` int(11) NOT NULL,
  `harga_vip` int(11) NOT NULL,
  `harga_supervip` int(11) NOT NULL,
  `deskripsi_konser` varchar(255) NOT NULL,
  `gambar_konser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konser`
--

INSERT INTO `konser` (`id`, `nama_artis`, `nama_konser`, `lokasi`, `waktu_konser`, `jam_konser`, `stock_supervip`, `stock_vip`, `stock_reguler`, `harga_reguler`, `harga_vip`, `harga_supervip`, `deskripsi_konser`, `gambar_konser`) VALUES
(4, 'Bruno Mars', 'Bruno Mars : Lazy Day Concert In Jakarta', 'Indonesia', '2025-05-15', '18:00:00', 50, 100, 130, 300000, 500000, 800000, '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi minus eveniet suscipit perferendis quia incidunt est rem modi provident id dolorum, possimus laboriosam enim distinctio maiores ullam quae beatae dicta!\n', 'img/konser_img/bruno.jpg'),
(5, 'Taylor Swift', 'Taylor Swift Love You All', 'Singapore', '2025-05-31', '17:00:00', 80, 90, 50, 2000000, 3000000, 5000000, '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi minus eveniet suscipit perferendis quia incidunt est rem modi provident id dolorum, possimus laboriosam enim distinctio maiores ullam quae beatae dicta!\r\n', 'img/konser_img/taylor.jpg'),
(6, 'Ed Sheeran', 'Ed Sheeran World Tour ', 'Australia', '2024-09-28', '17:00:00', 60, 70, 90, 5000000, 7000000, 10000000, '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi minus eveniet suscipit perferendis quia incidunt est rem modi provident id dolorum, possimus laboriosam enim distinctio maiores ullam quae beatae dicta!\r\n', 'img\\konser_img\\ed.jpg'),
(7, 'JKT48', 'JKT48 Rapsodi', 'Jakarta', '2024-06-29', '19:00:00', 90, 80, 150, 300000, 600000, 1000000, 'uigkiashdklajsdkjagsdaslkjdgbkjavskjhasjhasfdkjagskjagsdkjhahgsdkjaghsvkjhagsvdjhasd', 'img\\konser_img\\jkt48.jpg'),
(8, 'Alan Walker', 'Alan Walker World Tour : Mexico', 'Mexico', '2024-11-29', '19:30:00', 100, 200, 1000, 250000, 500000, 700000, 'fdtghjklygiyvklgutgkggkhhkgjhbj', 'img\\konser_img\\aw.jpeg'),
(9, 'Avenged Sevenfold', 'Avenged Sevenfold World Tour : Japan', 'Tokyo', '2025-02-01', '17:00:00', 119, 149, 198, 1000000, 2000000, 3000000, 'gjhkjhkjgdakjgsakdgkjagdkasgdakjsdbaskad', 'img\\konser_img\\as.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `konser_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `konser_id`, `type`, `first_name`, `last_name`, `phone_number`, `email`, `purchase_date`, `user_id`) VALUES
(1, 9, 'Reguler', 'asd', 'asde', '0987123134315', 'asd@gmail.com', '2024-06-08 02:37:51', 1),
(2, 8, 'Reguler', 'dasd', 'dasdas', '12313514', 'asd@gmail.com', '2024-06-08 02:40:30', 1),
(3, 9, 'VIP', 'a', 'a', '08778', 'a@gmail.com', '2024-06-08 03:26:58', 1),
(4, 9, 'Super VIP', 'a', 'a', '0987', 'a@gmail.com', '2024-06-08 03:29:46', 1),
(5, 9, 'Super VIP', 'a', 'a', '098', 'a@gmail.com', '2024-06-08 03:30:21', 1),
(6, 9, 'Super VIP', 'asd', 'io', '0987', 'op@gmail.com', '2024-06-08 03:55:10', 7),
(7, 9, 'VIP', 'uia', 'ghjkl', '09876', 'asda@gmail.com', '2024-06-08 11:03:04', 1),
(8, 9, 'Reguler', 'a', 'a', '09876', 'asd@gmail.com', '2024-06-08 11:42:20', 1),
(9, 9, 'VIP', 'asd', 'asde', '09876', 'asda@gmail.com', '2024-06-08 11:42:20', 1),
(10, 9, 'Super VIP', 'asd', 'asde', '09876', 'asd@gmail.com', '2024-06-08 11:42:20', 1),
(11, 9, 'Reguler', 'a', 'a', '0987', 'op@gmail.com', '2024-06-08 11:47:21', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'asd', 'asd@gmail.com', '$2y$10$L5i3UGZkFYYXK2t/QOoik.a3vghnnKwJaoPaNlsWArfHpq7t2KgOO'),
(3, 'a', 'a@gmail.com', '$2y$10$8WMi6GUg1Wsvo9y0CqQMGObhiy.YUpDnw/MepZ6atUponPMKKsSUS'),
(4, 'b', 'beta@gmail.com', '$2y$10$g3Qj8GeOqZxgdG2KIPevEOPtqtP9raGnDiBodjcm1OZb8wwFv.F56'),
(5, 'c', 'coba1@gmail.com', '$2y$10$6Qw8GtaAVeU6vEULM3J/Mu/3gS928GeloZrr76RFDoq5gd1vcyAKa'),
(6, 'ca', 'coba2@gmail.com', '$2y$10$VMlePfonJzB1mUIlpVOGW.mkFt9L1.bNjZrOcTy52ZMOuyJ.jeVJe'),
(7, 'op', 'op@gmail.cim', '$2y$10$YdoStx/NFCAwqu.A9KmKguSgCLWMvUOnLWegp.O6U3yO0hTsrca.6'),
(8, 'ada', 'ada@gmail.com', '$2y$10$aGn9K0v2nrg7QvwNyQu8Be28e0dCFBW8N5.L8f5DLnpcT/DI5oH5a');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konser_id` (`konser_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `konser`
--
ALTER TABLE `konser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`konser_id`) REFERENCES `konser` (`id`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
