--
-- Database: `import_csv`
--

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `train_line` varchar(11) NOT NULL,
  `route_name` varchar(8) NOT NULL,
  `run_number` varchar(55) NOT NULL,
  `operator_id` varchar(255) NOT NULL,
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`train_line`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trains`
--
ALTER TABLE `trains`
  MODIFY `train_line` varchar(11) NOT NULL AUTO_INCREMENT;