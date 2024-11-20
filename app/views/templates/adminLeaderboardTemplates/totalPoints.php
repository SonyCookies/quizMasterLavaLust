<div class=" relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8 w-full">
    <div class="border-b p-4">
        <h2 class="text-lg font-medium">Top Players</h2>
    </div>
    <table id="quizApproval" class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-blue-500">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Rank
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Points
                </th>
                <th scope="col" class="px-6 py-3">
                    Accuracy
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($totalPointsPlayers)): ?>
                <?php foreach ($totalPointsPlayers as $index => $points): ?>

                    <tr class="border-b">
                        <td scope="row" class="px-6 py-4 ">
                            <?php echo $index + 1 ?>
                        </td>
                        <th class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                            <?php echo $points['name'] ?>
                        </th>

                        <td class="px-6 py-4">
                            <?php if ($points['points'] === null) {
                                echo $points['points'] = 0 . ' pts';
                            } else {
                                echo $points['points'] . ' pts';
                            }

                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            // Use 0% as fallback if the value is not set or invalid
                            $accuracy = isset($points['accuracy']) && is_numeric($points['accuracy']) ? $points['accuracy'] : 0;
                            echo number_format($accuracy, 2) . '%';
                            ?> </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No player record
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>