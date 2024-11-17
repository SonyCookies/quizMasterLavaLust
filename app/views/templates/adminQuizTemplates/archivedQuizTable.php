<div class=" relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8 w-full">
    <table id="quizApproval" class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-green-500">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Quiz Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Difficulty
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Timed
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($forArchivedQuiz)): ?>
                <?php foreach ($forArchivedQuiz as $quiz): ?>
                    <tr class="border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?php echo $quiz['title'] ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $quiz['category'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $quiz['difficulty'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $quiz['quizType'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            if ($quiz['isTimed'] === 0) {
                                echo 'No';
                            } else {
                                echo 'Yes';
                            } ?>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="<?= site_url('admin/quizzes/publish/' . $quiz['quiz_id']) ?>" class="font-medium text-green-600 hover:text-green-700">Publish</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No archived quizzes
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>