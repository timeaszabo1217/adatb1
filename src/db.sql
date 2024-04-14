-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2023. Nov 26. 16:04
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mérési_adatok`
--

CREATE TABLE `mérési_adatok` (
  `mérés_id` int(11) NOT NULL,
  `érték` int(10) NOT NULL,
  `egység` varchar(20) NOT NULL,
  `időpont` datetime NOT NULL,
  `műszer_id` int(11) DEFAULT NULL,
  `hely_id` int(11) DEFAULT NULL,
  `operátor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mérési_adatok`
--

INSERT INTO `mérési_adatok` (`mérés_id`, `érték`, `egység`, `időpont`, `műszer_id`, `hely_id`, `operátor_id`) VALUES
(2661, 11, '°C', '2023-01-01 00:00:00', 43, 13, 22),
(2662, 11, '°C', '2023-01-23 00:00:00', 38, 12, 18),
(2663, 4, '°C', '2023-01-05 00:00:00', 33, 9, 9),
(2664, 11, '°C', '2023-01-26 00:00:00', 33, 13, 22),
(2665, 4, '°C', '2023-01-30 00:00:00', 33, 8, 20),
(2666, 16, '°C', '2023-02-14 00:00:00', 38, 13, 12),
(2667, 7, '°C', '2023-02-08 00:00:00', 33, 12, 8),
(2668, 11, '°C', '2023-02-19 00:00:00', 43, 9, 9),
(2669, 11, '°C', '2023-03-01 00:00:00', 33, 11, 20),
(2670, 20, '°C', '2023-03-24 00:00:00', 43, 12, 19),
(2671, 15, '°C', '2023-03-07 00:00:00', 38, 9, 17),
(2672, 18, '°C', '2023-03-08 00:00:00', 43, 13, 14),
(2673, 4, '°C', '2023-04-16 00:00:00', 38, 8, 13),
(2674, 19, '°C', '2023-04-14 00:00:00', 38, 13, 8),
(2675, 6, '°C', '2023-04-29 00:00:00', 43, 9, 23),
(2676, 9, '°C', '2023-04-30 00:00:00', 38, 8, 20),
(2677, 20, '°C', '2023-05-03 00:00:00', 38, 13, 6),
(2678, 10, '°C', '2023-05-20 00:00:00', 38, 9, 11),
(2679, 7, '°C', '2023-05-29 00:00:00', 33, 12, 5),
(2680, 22, '°C', '2023-05-06 00:00:00', 33, 11, 19),
(2681, 2, '°C', '2023-06-22 00:00:00', 33, 12, 21),
(2684, 10, '°C', '2023-06-05 00:00:00', 43, 11, 14),
(2685, 19, '°C', '2023-06-14 00:00:00', 38, 13, 6),
(2686, 3, '°C', '2023-07-19 00:00:00', 33, 8, 19),
(2687, 16, '°C', '2023-07-14 00:00:00', 43, 9, 7),
(2688, 10, '°C', '2023-07-26 00:00:00', 33, 13, 17),
(2689, 14, '°C', '2023-08-08 00:00:00', 43, 8, 12),
(2690, 8, '°C', '2023-08-02 00:00:00', 43, 9, 19),
(2691, 17, '°C', '2023-08-21 00:00:00', 43, 11, 20),
(2692, 18, '°C', '2023-08-15 00:00:00', 38, 13, 6),
(2693, 22, '°C', '2023-09-02 00:00:00', 43, 13, 18),
(2694, 21, '°C', '2023-09-18 00:00:00', 38, 9, 23),
(2695, 11, '°C', '2023-09-15 00:00:00', 33, 11, 20),
(2696, 7, '°C', '2023-09-14 00:00:00', 33, 8, 9),
(2697, 4, '°C', '2023-09-21 00:00:00', 38, 12, 6),
(2698, 20, '°C', '2023-10-11 00:00:00', 38, 8, 14),
(2699, 19, '°C', '2023-10-25 00:00:00', 33, 12, 19),
(2700, 10, '°C', '2023-10-27 00:00:00', 33, 8, 9),
(2701, 9, '°C', '2023-10-30 00:00:00', 33, 11, 15),
(2702, 2, '°C', '2023-11-10 00:00:00', 33, 9, 11),
(2703, 7, '°C', '2023-11-07 00:00:00', 33, 8, 7),
(2704, 16, '°C', '2023-11-07 00:00:00', 33, 13, 5),
(2705, 5, '°C', '2023-11-13 00:00:00', 33, 12, 8),
(2711, 2, '°C', '2023-01-10 00:00:00', 43, 12, 17),
(2712, 15, '°C', '2023-01-13 00:00:00', 42, 13, 16),
(2713, 22, '°C', '2023-01-12 00:00:00', 36, 8, 5),
(2714, 16, '°C', '2023-01-04 00:00:00', 39, 13, 21),
(2715, 14, '°C', '2023-02-10 00:00:00', 34, 9, 18),
(2716, 16, '°C', '2023-02-17 00:00:00', 34, 8, 13),
(2718, 21, '°C', '2023-01-11 00:00:00', 33, 11, 15),
(2719, 18, '°C', '2023-01-20 00:00:00', 42, 11, 11),
(2720, 2, '°C', '2023-01-20 00:00:00', 42, 8, 9),
(2721, 16, '°C', '2023-02-01 00:00:00', 43, 9, 16),
(2722, 19, '°C', '2023-02-19 00:00:00', 39, 11, 6),
(2724, 5, '°C', '2023-01-12 00:00:00', 39, 12, 20),
(2725, 4, '°C', '2023-01-20 00:00:00', 38, 9, 11),
(2726, 2, '°C', '2023-01-25 00:00:00', 37, 12, 21),
(2727, 11, '°C', '2023-02-19 00:00:00', 41, 9, 18),
(2728, 3, '°C', '2023-02-26 00:00:00', 39, 12, 20),
(2729, 14, '°C', '2023-02-17 00:00:00', 34, 9, 6),
(2730, 18, '°C', '2023-03-04 00:00:00', 38, 9, 21),
(2731, 12, '°C', '2023-03-06 00:00:00', 39, 12, 18),
(2732, 4, '°C', '2023-03-21 00:00:00', 34, 13, 23),
(2733, 12, '°C', '2023-04-04 00:00:00', 37, 12, 20),
(2735, 21, '°C', '2023-01-03 00:00:00', 33, 9, 22),
(2736, 11, '°C', '2023-01-25 00:00:00', 43, 9, 13),
(2737, 19, '°C', '2023-01-03 00:00:00', 40, 12, 15),
(2738, 15, '°C', '2023-01-01 00:00:00', 36, 13, 11),
(2739, 3, '°C', '2023-01-04 00:00:00', 33, 13, 23),
(2740, 2, '°C', '2023-02-19 00:00:00', 37, 12, 11),
(2741, 8, '°C', '2023-02-19 00:00:00', 39, 11, 21),
(2742, 18, '°C', '2023-02-25 00:00:00', 34, 11, 13),
(2743, 12, '°C', '2023-02-01 00:00:00', 40, 11, 7),
(2744, 13, '°C', '2023-02-05 00:00:00', 38, 9, 13),
(2745, 15, '°C', '2023-03-06 00:00:00', 39, 8, 21),
(2746, 13, '°C', '2023-03-03 00:00:00', 39, 8, 21),
(2747, 4, '°C', '2023-03-15 00:00:00', 33, 8, 6),
(2750, 9, '°C', '2023-04-03 00:00:00', 41, 8, 20),
(2751, 12, '°C', '2023-04-18 00:00:00', 33, 12, 21),
(2752, 21, '°C', '2023-04-18 00:00:00', 43, 13, 10),
(2753, 20, '°C', '2023-04-07 00:00:00', 34, 9, 22),
(2755, 18, '°C', '2023-04-27 00:00:00', 38, 12, 20),
(2756, 2, '°C', '2023-04-13 00:00:00', 35, 8, 9),
(2757, 13, '°C', '2023-04-26 00:00:00', 35, 9, 21),
(2758, 2, '°C', '2023-05-21 00:00:00', 40, 12, 13),
(2759, 21, '°C', '2023-05-03 00:00:00', 37, 9, 11),
(2760, 13, '°C', '2023-05-16 00:00:00', 35, 8, 6),
(2761, 15, '°C', '2023-05-21 00:00:00', 41, 8, 14),
(2762, 8, '°C', '2023-05-22 00:00:00', 35, 11, 19),
(2763, 17, '°C', '2023-06-17 00:00:00', 37, 11, 5),
(2764, 2, '°C', '2023-06-08 00:00:00', 41, 11, 15),
(2765, 21, '°C', '2023-06-24 00:00:00', 35, 13, 23),
(2766, 21, '°C', '2023-06-25 00:00:00', 42, 13, 12),
(2768, 7, '°C', '2023-07-10 00:00:00', 42, 9, 6),
(2769, 11, '°C', '2023-07-26 00:00:00', 40, 9, 12),
(2770, 13, '°C', '2023-07-16 00:00:00', 43, 11, 9),
(2771, 15, '°C', '2023-08-28 00:00:00', 40, 13, 11),
(2772, 17, '°C', '2023-08-15 00:00:00', 33, 13, 9),
(2774, 8, '°C', '2023-07-10 00:00:00', 36, 12, 9),
(2775, 18, '°C', '2023-07-02 00:00:00', 34, 9, 12),
(2776, 3, '°C', '2023-07-29 00:00:00', 37, 12, 22),
(2777, 13, '°C', '2023-07-11 00:00:00', 35, 12, 23),
(2778, 3, '°C', '2023-08-15 00:00:00', 35, 13, 22),
(2779, 19, '°C', '2023-08-28 00:00:00', 33, 11, 16),
(2780, 13, '°C', '2023-08-20 00:00:00', 37, 9, 20),
(2781, 11, '°C', '2023-08-16 00:00:00', 41, 12, 5),
(2782, 22, '°C', '2023-08-09 00:00:00', 34, 12, 20),
(2783, 12, '°C', '2023-09-15 00:00:00', 37, 13, 20),
(2784, 22, '°C', '2023-09-30 00:00:00', 43, 11, 9),
(2785, 19, '°C', '2023-09-18 00:00:00', 37, 9, 6),
(2786, 18, '°C', '2023-09-16 00:00:00', 33, 13, 10),
(2787, 11, '°C', '2023-09-29 00:00:00', 37, 12, 14),
(2788, 14, '°C', '2023-10-19 00:00:00', 42, 11, 14),
(2789, 12, '°C', '2023-10-13 00:00:00', 43, 11, 17),
(2790, 8, '°C', '2023-10-12 00:00:00', 33, 9, 5),
(2791, 5, '°C', '2023-10-15 00:00:00', 37, 9, 8),
(2792, 10, '°C', '2023-11-11 00:00:00', 36, 9, 10),
(2793, 10, '°C', '2023-11-16 00:00:00', 34, 9, 5),
(2794, 19, '°C', '2023-11-30 00:00:00', 37, 8, 20),
(2795, 22, '°C', '2023-12-20 00:00:00', 42, 11, 15),
(2796, 5, '°C', '2023-12-17 00:00:00', 34, 13, 6),
(2797, 16, '°C', '2023-12-09 00:00:00', 38, 11, 12),
(2798, 7, '°C', '2023-12-04 00:00:00', 40, 11, 18),
(2799, 15, '°C', '2023-12-16 00:00:00', 41, 12, 17),
(2800, 4, '°C', '2023-07-17 00:00:00', 36, 8, 19),
(2801, 3, '°C', '2023-07-27 00:00:00', 41, 9, 23),
(2802, 8, '°C', '2023-07-10 00:00:00', 34, 8, 19),
(2803, 15, '°C', '2023-07-26 00:00:00', 38, 9, 5),
(2804, 13, '°C', '2023-08-19 00:00:00', 35, 8, 5),
(2805, 8, '°C', '2023-08-12 00:00:00', 37, 9, 11),
(2807, 19, '°C', '2023-07-14 00:00:00', 40, 9, 11),
(2808, 21, '°C', '2023-07-01 00:00:00', 43, 8, 13),
(2809, 7, '°C', '2023-07-12 00:00:00', 36, 8, 20),
(2810, 19, '°C', '2023-08-31 00:00:00', 39, 8, 14),
(2811, 14, '°C', '2023-08-16 00:00:00', 33, 9, 17),
(2813, 4, '°C', '2023-10-27 00:00:00', 36, 9, 6),
(2815, 3, '°C', '2023-10-02 00:00:00', 36, 12, 23),
(2816, 14, '°C', '2023-10-12 00:00:00', 43, 8, 7),
(2818, 21, '°C', '2023-10-25 00:00:00', 39, 9, 12),
(2819, 14, '°C', '2023-10-21 00:00:00', 43, 9, 21),
(2820, 10, '°C', '2023-11-20 00:00:00', 42, 9, 20),
(2821, 14, '°C', '2023-11-02 00:00:00', 35, 9, 11),
(2822, 20, '°C', '2023-11-15 00:00:00', 39, 13, 8),
(2823, 11, '°C', '2023-11-19 00:00:00', 38, 12, 22),
(2824, 9, '°C', '2023-11-27 00:00:00', 43, 11, 16),
(2825, 3, '°C', '2023-12-06 00:00:00', 33, 13, 12),
(2826, 8, '°C', '2023-12-03 00:00:00', 43, 13, 10),
(2827, 6, '°C', '2023-12-12 00:00:00', 37, 9, 8),
(2828, 5, '°C', '2023-12-14 00:00:00', 39, 12, 18),
(2829, 3, '°C', '2023-12-30 00:00:00', 42, 12, 16),
(2831, 13, '°C', '2023-12-19 00:00:00', 41, 12, 5),
(2833, 21, '°C', '2023-12-26 00:00:00', 40, 8, 8),
(2834, 17, '°C', '2023-12-29 00:00:00', 41, 13, 8),
(2835, 11, '°C', '2023-12-31 00:00:00', 38, 9, 18),
(2837, 3, '°C', '2023-12-08 00:00:00', 39, 12, 19),
(2838, 7, '°C', '2023-12-23 00:00:00', 33, 9, 9),
(2839, 13, '°C', '2023-12-27 00:00:00', 35, 11, 9),
(2840, 16, '°C', '2023-04-28 00:00:00', 38, 9, 12),
(2842, 18, '°C', '2023-04-26 00:00:00', 33, 13, 6),
(2843, 12, '°C', '2023-04-18 00:00:00', 36, 13, 12),
(2844, 5, '°C', '2023-04-11 00:00:00', 39, 9, 22),
(2845, 16, '°C', '2023-04-12 00:00:00', 33, 12, 15),
(2846, 8, '°C', '2023-04-25 00:00:00', 40, 8, 12),
(2847, 18, '°C', '2023-06-14 00:00:00', 34, 12, 19),
(2848, 12, '°C', '2023-06-16 00:00:00', 33, 11, 18),
(2849, 21, '°C', '2023-06-24 00:00:00', 40, 12, 22),
(2850, 20, '°C', '2023-07-17 00:00:00', 39, 11, 9),
(2852, 16, '°C', '2023-06-29 00:00:00', 40, 11, 14),
(2854, 22, '°C', '2023-06-28 00:00:00', 37, 11, 16),
(2857, 18, '°C', '2023-06-24 00:00:00', 43, 9, 14),
(2858, 12, '°C', '2023-06-30 00:00:00', 38, 13, 5),
(2860, 2, '°C', '2023-06-09 00:00:00', 40, 8, 5),
(2862, 12, '°C', '2023-06-16 00:00:00', 34, 13, 14),
(2863, 5, '°C', '2023-06-22 00:00:00', 33, 8, 8),
(2864, 7, '°C', '2023-06-27 00:00:00', 33, 11, 8),
(2865, 9, '°C', '2023-07-25 00:00:00', 35, 8, 6),
(2866, 20, '°C', '2023-07-07 00:00:00', 36, 11, 10),
(2867, 21, '°C', '2023-07-27 00:00:00', 33, 12, 6),
(2868, 7, '°C', '2023-07-14 00:00:00', 38, 13, 16),
(2869, 14, '°C', '2023-07-13 00:00:00', 42, 11, 8),
(2871, 14, '°C', '2023-04-24 00:00:00', 39, 8, 19),
(2872, 20, '°C', '2023-04-18 00:00:00', 40, 8, 20),
(2874, 8, '°C', '2023-04-28 00:00:00', 36, 9, 17),
(2875, 12, '°C', '2023-04-27 00:00:00', 36, 13, 9),
(2876, 22, '°C', '2023-04-19 00:00:00', 38, 13, 8),
(2877, 15, '°C', '2023-04-17 00:00:00', 34, 11, 12),
(2878, 22, '°C', '2023-04-23 00:00:00', 39, 13, 15),
(2879, 8, '°C', '2023-04-08 00:00:00', 38, 8, 12),
(2880, 5, '°C', '2023-04-10 00:00:00', 37, 8, 17),
(2882, 20, '°C', '2023-01-06 00:00:00', 43, 11, 5),
(2883, 22, '°C', '2023-01-14 00:00:00', 38, 11, 13),
(2886, 8, '°C', '2023-11-14 00:00:00', 34, 12, 12),
(2887, 8, '°C', '2023-11-07 00:00:00', 34, 13, 14),
(2888, 20, '°C', '2023-11-25 00:00:00', 34, 13, 8),
(2889, 9, '°C', '2023-11-16 00:00:00', 40, 13, 10),
(2890, 14, '°C', '2023-11-06 00:00:00', 33, 13, 12),
(2892, 4, '°C', '2023-11-03 00:00:00', 37, 12, 17),
(2894, 12, '°C', '2023-11-19 00:00:00', 40, 11, 18),
(2896, 20, '°C', '2023-11-30 00:00:00', 42, 11, 15),
(2897, 16, '°C', '2023-11-16 00:00:00', 38, 9, 16),
(2898, 4, '°C', '2023-11-03 00:00:00', 37, 11, 22),
(2899, 21, '°C', '2023-11-06 00:00:00', 43, 11, 10),
(2900, 17, '°C', '2023-11-01 00:00:00', 33, 11, 18),
(2901, 3, '°C', '2023-11-07 00:00:00', 39, 12, 21),
(2902, 19, '°C', '2023-11-17 00:00:00', 41, 12, 8),
(2903, 7, '°C', '2023-11-23 00:00:00', 34, 13, 20),
(2904, 2, '°C', '2023-11-11 00:00:00', 35, 13, 21),
(2905, 7, '°C', '2023-11-18 00:00:00', 34, 8, 9),
(2906, 11, '°C', '2023-11-04 00:00:00', 35, 8, 19),
(2907, 18, '°C', '2023-11-06 00:00:00', 37, 12, 22),
(2908, 12, '°C', '2023-11-06 00:00:00', 43, 9, 15),
(2909, 10, '°C', '2023-11-23 00:00:00', 35, 13, 22),
(2910, 19, '°C', '2023-11-19 00:00:00', 36, 11, 9),
(2912, 15, '°C', '2023-11-21 00:00:00', 42, 13, 21),
(2913, 18, '°C', '2023-11-03 00:00:00', 40, 11, 5),
(2915, 4, '°C', '2023-11-27 00:00:00', 41, 13, 22),
(2916, 2, '°C', '2023-11-20 00:00:00', 43, 11, 11),
(2917, 15, '°C', '2023-11-09 00:00:00', 39, 9, 12),
(2918, 8, '°C', '2023-11-23 00:00:00', 39, 9, 21),
(2919, 21, '°C', '2023-11-14 00:00:00', 40, 8, 6),
(2920, 4, '°C', '2023-11-04 00:00:00', 35, 11, 6),
(2921, 11, '°C', '2023-11-07 00:00:00', 33, 9, 20),
(2923, 12, '°C', '2023-11-16 00:00:00', 36, 13, 13),
(2924, 19, '°C', '2023-11-19 00:00:00', 34, 8, 18),
(2925, 16, '°C', '2023-11-04 00:00:00', 33, 8, 22),
(2926, 15, '°C', '2023-11-20 00:00:00', 43, 11, 20),
(2927, 13, '°C', '2023-11-01 00:00:00', 38, 9, 18),
(2928, 4, '°C', '2023-11-23 00:00:00', 41, 12, 12),
(2929, 19, '°C', '2023-11-21 00:00:00', 40, 12, 12),
(2930, 14, '°C', '2023-11-27 00:00:00', 41, 9, 9),
(2931, 20, '°C', '2023-11-20 00:00:00', 39, 11, 12),
(2933, 5, '°C', '2023-11-13 00:00:00', 38, 8, 18),
(2935, 21, '°C', '2023-11-11 00:00:00', 38, 13, 12),
(2936, 20, '°C', '2023-11-13 00:00:00', 39, 11, 5),
(2937, 21, '°C', '2023-11-04 00:00:00', 43, 11, 22),
(2938, 12, '°C', '2023-11-28 00:00:00', 35, 8, 18),
(2939, 16, '°C', '2023-11-27 00:00:00', 38, 13, 7),
(2940, 8, '°C', '2023-11-01 00:00:00', 43, 13, 13),
(2942, 22, '°C', '2023-11-25 00:00:00', 34, 13, 17),
(2943, 10, '°C', '2023-11-30 00:00:00', 43, 12, 23),
(2944, 10, '°C', '2023-11-21 00:00:00', 43, 8, 16),
(2945, 20, '°C', '2023-11-12 00:00:00', 43, 8, 9),
(2946, 2, '°C', '2023-11-28 00:00:00', 37, 11, 17),
(2947, 20, '°C', '2023-11-19 00:00:00', 40, 8, 22),
(2948, 22, '°C', '2023-11-20 00:00:00', 38, 12, 11),
(2949, 7, '°C', '2023-11-22 00:00:00', 38, 9, 6),
(2950, 22, '°C', '2023-11-22 00:00:00', 34, 13, 17),
(2951, 2, '°C', '2023-11-30 00:00:00', 43, 8, 8),
(2952, 16, '°C', '2023-11-13 00:00:00', 33, 8, 21),
(2953, 7, '°C', '2023-11-26 00:00:00', 40, 9, 9),
(2955, 9, '°C', '2023-11-26 00:00:00', 33, 8, 20),
(2956, 22, '°C', '2023-11-26 00:00:00', 41, 8, 20),
(2957, 20, '°C', '2023-11-26 00:00:00', 42, 11, 10);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mérőműszerek`
--

CREATE TABLE `mérőműszerek` (
  `műszer_id` int(11) NOT NULL,
  `típus` varchar(50) NOT NULL,
  `modell_szám` varchar(50) NOT NULL,
  `állapot` varchar(50) NOT NULL,
  `műszer_neve` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mérőműszerek`
--

INSERT INTO `mérőműszerek` (`műszer_id`, `típus`, `modell_szám`, `állapot`, `műszer_neve`) VALUES
(33, 'Hőmérő', 'T-1000', 'használatban', 'Hőmérő 1'),
(34, 'Csapadékmérő', 'RainSense-200', 'használaton kívül', 'Csapadékmérő 1'),
(35, 'Szélsebességmérő', 'WindMaster-5000', 'javítás alatt', 'Szélsebességmérő 1'),
(36, 'Felhőzetmérő', 'CloudSense-300', 'használatban', 'Felhőzetmérő 1'),
(37, 'Légnyomásmérő', 'PressurePro-700', 'használaton kívül', 'Légnyomásmérő 1'),
(38, 'Hőmérő', 'T-1001', 'használaton kívül', 'Hőmérő 2'),
(39, 'Csapadékmérő', 'RainSense-201', 'javítás alatt', 'Csapadékmérő 2'),
(40, 'Szélsebességmérő', 'WindMaster-5001', 'használaton kívül', 'Szélsebességmérő 2'),
(41, 'Felhőzetmérő', 'CloudSense-301', 'használatban', 'Felhőzetmérő 2'),
(42, 'Légnyomásmérő', 'PressurePro-701', 'javítás alatt', 'Légnyomásmérő 2'),
(43, 'Hőmérő', 'T-1002', 'javítás alatt', 'Hőmérő 3'),
(44, 'Csapadékmérő', 'RainSense-202', 'használatban', 'Csapadékmérő 3');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mérőműszer_helyek`
--

CREATE TABLE `mérőműszer_helyek` (
  `mér_hely_id` int(11) NOT NULL,
  `hely_id` int(11) NOT NULL,
  `műszer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mérőműszer_helyek`
--

INSERT INTO `mérőműszer_helyek` (`mér_hely_id`, `hely_id`, `műszer_id`) VALUES
(110, 8, 33),
(111, 9, 36),
(113, 11, 41),
(114, 12, 44);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mérőállomások`
--

CREATE TABLE `mérőállomások` (
  `hely_id` int(11) NOT NULL,
  `település` varchar(100) NOT NULL,
  `vármegye` varchar(100) NOT NULL,
  `hely_neve` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mérőállomások`
--

INSERT INTO `mérőállomások` (`hely_id`, `település`, `vármegye`, `hely_neve`) VALUES
(8, 'Budapest', 'Pest', 'Belváros'),
(9, 'Debrecen', 'Hajdú-Bihar', 'Újváros'),
(11, 'Miskolc', 'Borsod-Abaúj-Zemplén', 'Alsóváros'),
(12, 'Pécs', 'Baranya', 'Felsőváros'),
(13, 'Szeged', 'Csongrád', 'Felsőváros');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `operátorok`
--

CREATE TABLE `operátorok` (
  `operátor_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jelszó` varchar(100) NOT NULL,
  `név` varchar(100) NOT NULL,
  `bejelentkezett` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `operátorok`
--

INSERT INTO `operátorok` (`operátor_id`, `email`, `jelszó`, `név`, `bejelentkezett`) VALUES
(5, 'john@example.com', '$2y$10$wzyf2hqk/W2Xr7tuMEIZbuScSGCsPmNQwOHw7adNtpZloyw0JK3dG', 'John Doe', 0),
(6, 'jane@example.com', '$2y$10$kpvVKlTrcj0fM/Wm9MOGgeeIwwbinBIZfMXu2P/BTIJj3cse9FOmq', 'Jane Smith', 0),
(7, 'alice@example.com', '$2y$10$CThkoLoAe11/apWr3DUkAuAN8VrjWIstdG4yUd..B2t/tJLpTKrRK', 'Alice Johnson', 0),
(8, 'bob@example.com', '$2y$10$rqi4WmnehwgHcc/z.H9lreSuqpDachF8VSEXtWt506pHlRdA/c9x2', 'Bob Jackson', 0),
(9, 'emma@example.com', '$2y$10$6y/WRVYN65eCHl3sA1KFl.UvQRg.HDulzgvSL5hcLbZdj/g0SrL4.', 'Emma Thompson', 0),
(10, 'william@example.com', '$2y$10$ojTg/m.OfJTqP/ur1RSPnOrLUCZTWOnawydGQWTpU15EaM9t5X1FS', 'William Morris', 0),
(11, 'olivia@example.com', '$2y$10$Z1ro7fOkQPvOkPPvgHcuduksqO5bfVX1b7ORLw4PGl2POqdq08J4.', 'Olivia Cook', 0),
(12, 'sophia@example.com', '$2y$10$UshuxlLpPIVdR014BIb//ejhHtxa8V0Sd3yo68NYtCbL8RWgxEK5O', 'Sophia Rogers', 0),
(13, 'daniel@example.com', '$2y$10$npfTDmFlls3sVW/QIU2/WuQzkuBg8yQCE1MrOjt3TMWUV3FqFaBUG', 'Daniel Griffin', 0),
(14, 'oliver@example.com', '$2y$10$yyfR.zYSaf2bSq7se6EFduHHBXEkYuOzu7V8fkVyClG/TX/nFklQa', 'Oliver Hall', 0),
(15, 'amelia@example.com', '$2y$10$U0UaVNyaPioqBNTneG1so.ssSQlseAZ.J6n7wjcWvovvUM65K.vh2', 'Amelia Watson', 0),
(16, 'ava@example.com', '$2y$10$f8qU8k8Wwv0XUJdwrDkEQuRPDhUU/yHGeK8OYlOMHbX9pvnq/q.xq', 'Ava Brooks', 0),
(17, 'noah@example.com', '$2y$10$WgIA01n7LYQOeSNUaHM70.G1kz9f3KoSTnf135qW5ENU4BgYnC72y', 'Noah Turner', 0),
(18, 'james@example.com', '$2y$10$UazfiOgQykXLajS4lyoZl.kuIenH8AzdLKA/l21bL3MRCZgQTpPRy', 'James Murphy', 0),
(19, 'isabella@example.com', '$2y$10$A1tKG7Ms3Rxr92E.zFbH2.rLO.qisp4g.vqAzXqOki0KzAFMxKfxC', 'Isabella King', 0),
(20, 'logan@example.com', '$2y$10$4ygSfOjJkTYLSbewIQD4EexYa/Aj7uPJlcFuYDd176meL5weUGGNm', 'Logan Scott', 0),
(21, 'alexander@example.com', '$2y$10$arhvmmksQdS.YSRoxXEPk..4VNuKvCVXngHXm.hAqkN6qSFSuIP0i', 'Alexander Clarke', 0),
(22, 'grace@example.com', '$2y$10$o0tz16MyoQ523Txw5Xa6BO5HTSNGztAmRyP5iZCfJKTZascSJ1s.m', 'Grace Allen', 0),
(23, 'hannah@example.com', '$2y$10$MveSzCgr.7LWgTNpEXjPg.o1fyBd5Bcx5MGlC5j5oKLduM0SBQFVG', 'Hannah Morris', 0),
(26, 'timeaszabo1217@gmail.com', '$2y$10$Q7U6uyzzMO0xdeBy1AzcT.OKtW6O8eIJ5tVl8oskrh2tybYhGvyR6', 'Szabó Tímea', 0),
(27, 'nagyonnagycicavagyok@gmail.com', '$2y$10$3j4CwaUw/guFHlCnCepI1uKX2BP5m8B7CNo8ZrZ1vZz1TjB0O96S2', 'Szabó Tímea', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `operátor_helyek`
--

CREATE TABLE `operátor_helyek` (
  `operátor_id` int(11) DEFAULT NULL,
  `hely_id` int(11) DEFAULT NULL,
  `op_hely_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `operátor_helyek`
--

INSERT INTO `operátor_helyek` (`operátor_id`, `hely_id`, `op_hely_id`) VALUES
(5, 12, 1),
(23, 13, 17);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `mérési_adatok`
--
ALTER TABLE `mérési_adatok`
  ADD PRIMARY KEY (`mérés_id`),
  ADD KEY `műszer_id` (`műszer_id`),
  ADD KEY `hely_id` (`hely_id`),
  ADD KEY `operátor_id` (`operátor_id`);

--
-- A tábla indexei `mérőműszerek`
--
ALTER TABLE `mérőműszerek`
  ADD PRIMARY KEY (`műszer_id`);

--
-- A tábla indexei `mérőműszer_helyek`
--
ALTER TABLE `mérőműszer_helyek`
  ADD PRIMARY KEY (`mér_hely_id`),
  ADD KEY `hely_id` (`hely_id`),
  ADD KEY `műszer_id` (`műszer_id`);

--
-- A tábla indexei `mérőállomások`
--
ALTER TABLE `mérőállomások`
  ADD PRIMARY KEY (`hely_id`);

--
-- A tábla indexei `operátorok`
--
ALTER TABLE `operátorok`
  ADD PRIMARY KEY (`operátor_id`,`email`);

--
-- A tábla indexei `operátor_helyek`
--
ALTER TABLE `operátor_helyek`
  ADD PRIMARY KEY (`op_hely_id`),
  ADD KEY `hely_id` (`hely_id`),
  ADD KEY `operátor_id` (`operátor_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `mérési_adatok`
--
ALTER TABLE `mérési_adatok`
  MODIFY `mérés_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2958;

--
-- AUTO_INCREMENT a táblához `mérőműszerek`
--
ALTER TABLE `mérőműszerek`
  MODIFY `műszer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234;

--
-- AUTO_INCREMENT a táblához `mérőműszer_helyek`
--
ALTER TABLE `mérőműszer_helyek`
  MODIFY `mér_hely_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT a táblához `mérőállomások`
--
ALTER TABLE `mérőállomások`
  MODIFY `hely_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=616;

--
-- AUTO_INCREMENT a táblához `operátorok`
--
ALTER TABLE `operátorok`
  MODIFY `operátor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT a táblához `operátor_helyek`
--
ALTER TABLE `operátor_helyek`
  MODIFY `op_hely_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `mérési_adatok`
--
ALTER TABLE `mérési_adatok`
  ADD CONSTRAINT `mérési_adatok_ibfk_1` FOREIGN KEY (`műszer_id`) REFERENCES `mérőműszerek` (`műszer_id`),
  ADD CONSTRAINT `mérési_adatok_ibfk_2` FOREIGN KEY (`hely_id`) REFERENCES `mérőállomások` (`hely_id`),
  ADD CONSTRAINT `mérési_adatok_ibfk_3` FOREIGN KEY (`operátor_id`) REFERENCES `operátorok` (`operátor_id`);

--
-- Megkötések a táblához `mérőműszer_helyek`
--
ALTER TABLE `mérőműszer_helyek`
  ADD CONSTRAINT `mérőműszer_helyek_ibfk_1` FOREIGN KEY (`hely_id`) REFERENCES `mérőállomások` (`hely_id`),
  ADD CONSTRAINT `mérőműszer_helyek_ibfk_2` FOREIGN KEY (`műszer_id`) REFERENCES `mérőműszerek` (`műszer_id`);

--
-- Megkötések a táblához `operátor_helyek`
--
ALTER TABLE `operátor_helyek`
  ADD CONSTRAINT `hely_id` FOREIGN KEY (`hely_id`) REFERENCES `mérőállomások` (`hely_id`),
  ADD CONSTRAINT `operátor_id` FOREIGN KEY (`operátor_id`) REFERENCES `operátorok` (`operátor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
