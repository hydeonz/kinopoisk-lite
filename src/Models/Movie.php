<?php

namespace App\Models;

use App\Controllers\MovieController;
use App\Kernel\Database\DatabaseInterface;

class Movie
{

    public function __construct(
        private int $id,
        private string $name,
        private string $description,
        private string $preview,
        private int $categoryId,
        private string $createdAt,
        private array $reviews = []
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function preview(): string
    {
        return $this->preview;
    }

    public function categoryId(): int
    {
        return $this->categoryId;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return array<Review>
     */
    public function reviews(): array
    {
        return $this->reviews;
    }

    public function avgRating(): float
    {
        $this->reviews();
        $ratings = array_map(function (Review $review) {
            return $review->rating();
        }, $this->reviews);
        if (count($ratings) === 0) {
            return 0;
        }

        return round(array_sum($ratings) / count($ratings), 1);
    }
}
