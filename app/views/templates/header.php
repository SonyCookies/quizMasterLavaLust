<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LavaLust UI</title>
	<link rel="icon" type="image/png" href="<?= base_url(); ?>public/img/favicon.ico" />
	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="<?= base_url(); ?>public/css/main.css" rel="stylesheet">

	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


	<!-- Toastr CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Toastr JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	<script>
		tailwind.config = {
			darkMode: 'media',
			theme: {
				extend: {
					colors: {
						border: "hsl(var(--border))",
						input: "hsl(var(--input))",
						ring: "hsl(var(--ring))",
						background: "hsl(var(--background))",
						foreground: "hsl(var(--foreground))",
						primary: {
							DEFAULT: "hsl(var(--primary))",
							foreground: "hsl(var(--primary-foreground))",
						},
						secondary: {
							DEFAULT: "hsl(var(--secondary))",
							foreground: "hsl(var(--secondary-foreground))",
						},
						destructive: {
							DEFAULT: "hsl(var(--destructive))",
							foreground: "hsl(var(--destructive-foreground))",
						},
						muted: {
							DEFAULT: "hsl(var(--muted))",
							foreground: "hsl(var(--muted-foreground))",
						},
						accent: {
							DEFAULT: "hsl(var(--accent))",
							foreground: "hsl(var(--accent-foreground))",
						},
						popover: {
							DEFAULT: "hsl(var(--popover))",
							foreground: "hsl(var(--popover-foreground))",
						},
						card: {
							DEFAULT: "hsl(var(--card))",
							foreground: "hsl(var(--card-foreground))",
						},
					},
				},
			},
		}
	</script>
	<!-- <style>
		@layer base {
			:root {
				--background: 0 0% 100%;
				--foreground: 222.2 84% 4.9%;
				--card: 0 0% 100%;
				--card-foreground: 222.2 84% 4.9%;
				--popover: 0 0% 100%;
				--popover-foreground: 222.2 84% 4.9%;
				--primary: 221.2 83.2% 53.3%;
				--primary-foreground: 210 40% 98%;
				--secondary: 210 40% 96.1%;
				--secondary-foreground: 222.2 47.4% 11.2%;
				--muted: 210 40% 96.1%;
				--muted-foreground: 215.4 16.3% 46.9%;
				--accent: 210 40% 96.1%;
				--accent-foreground: 222.2 47.4% 11.2%;
				--destructive: 0 84.2% 60.2%;
				--destructive-foreground: 210 40% 98%;
				--border: 214.3 31.8% 91.4%;
				--input: 214.3 31.8% 91.4%;
				--ring: 221.2 83.2% 53.3%;
				--radius: 0.5rem;
			}

			.dark {
				--background: 222.2 84% 4.9%;
				--foreground: 210 40% 98%;
				--card: 222.2 84% 4.9%;
				--card-foreground: 210 40% 98%;
				--popover: 222.2 84% 4.9%;
				--popover-foreground: 210 40% 98%;
				--primary: 217.2 91.2% 59.8%;
				--primary-foreground: 222.2 47.4% 11.2%;
				--secondary: 217.2 32.6% 17.5%;
				--secondary-foreground: 210 40% 98%;
				--muted: 217.2 32.6% 17.5%;
				--muted-foreground: 215 20.2% 65.1%;
				--accent: 217.2 32.6% 17.5%;
				--accent-foreground: 210 40% 98%;
				--destructive: 0 62.8% 30.6%;
				--destructive-foreground: 210 40% 98%;
				--border: 217.2 32.6% 17.5%;
				--input: 217.2 32.6% 17.5%;
				--ring: 224.3 76.3% 48%;
			}
		}
	</style> -->
</head>