<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <script src="../js/components.js"></script>
    <script src="https://cdn.tailwindcss.com"></script> 
    <title>Consumer Satisfaction</title>
</head>

<body class="bg-gray-100">
    <custom-navbar></custom-navbar>

    <div class="w-[80%] m-auto relative mt-5">
        <div class="flex justify-center items-center">
            <h1 class="text-4xl font-bold">Consumer Satisfaction Survey</h1>
        </div>

        <section class="mt-10 max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <form class="w-full" action="" method="POST">
                <label class="font-semibold block mt-4" for="name">Your Name:</label>
                <input class="block w-full bg-gray-100 p-2 border border-gray-300 rounded" type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">

                <label class="font-semibold block mt-4" for="rating">Rating (1-5):</label>
                <select class="block w-full bg-gray-100 p-2 border border-gray-300 rounded" id="rating" name="rating" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Very Bad</option>
                </select>

                <label class="font-semibold block mt-4" for="feedback">Your Feedback:</label>
                <textarea class="block w-full bg-gray-100 p-2 border border-gray-300 rounded" id="feedback" name="feedback" rows="4" required><?php echo htmlspecialchars($_POST['feedback'] ?? ''); ?></textarea>

                <div class="flex flex-col items-center justify-center gap-3 mt-5 w-full">
                    <input type="submit" value="Submit"
                        class="bg-black text-white hover:bg-white hover:text-black hover:border-black px-6 py-2 border-2 border-gray-200 text-center text-md transition ease-in-out duration-100 w-full md:w-auto block">
                </div>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = htmlspecialchars($_POST["name"]);
                $rating = intval($_POST["rating"]);
                $feedback = htmlspecialchars($_POST["feedback"]);

                if (!empty($name) && !empty($feedback)) {
                    $timestamp = date("Y-m-d_H-i-s");
                    $filename = "../responses/feedback_$timestamp.txt";
                    $data = "Name: $name\nRating: $rating/5\nFeedback: $feedback\n\n";
                    file_put_contents($filename, $data, FILE_APPEND);

                    echo "<p class='text-green-500 text-md text-center mt-5'>Thank you for your feedback!</p>";
                } else {
                    echo "<p class='text-red-500 text-md text-center mt-5'>Please fill in all fields.</p>";
                }
            }
            ?>
        </section>
    </div>
</body>
</html>
