<div class=" relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8 w-full">
    <div class="border-b p-4">
        <h2 class="text-lg font-medium">Top Weekly Players</h2>
    </div>
    <table id="quizApproval" class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-orange-500">
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
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($weeklyPlayers)): ?>
                <?php foreach ($weeklyPlayers as $index => $points): ?>
                    <tr class="border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?php echo $index + 1 ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $points['name'] ?>
                        </td>

                        <td class="px-6 py-4">
                            <?php if ($points['points'] === null) {
                                echo $points['points'] = 0 . ' pts';
                            } else {
                                echo $points['points'] . ' pts';
                            }

                            ?>
                        </td>

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