<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8">
    <div class="border-b p-4">
        <h2 class="text-lg font-medium">List of All Users</h2>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-blue-500">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Date created
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>

            </tr>
        </thead>

        <tbody>
            <?php if (!empty($allUser)): ?>
                <?php foreach ($allUser as $user): ?>
                    <tr class="border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?php echo $user['username'] ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $user['email'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php

                            $date = date_create($user['created_at']);
                            echo date_format($date, "Y-m-d");

                            ?>
                        </td>

                        <td class="px-6 py-4 space-x-2">
                            <a href="<?= site_url('admin/users/deactivate/' . $user['id']) ?>" class="font-medium text-red-600 hover:text-red-700">Deactivate</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No user record
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
</div>