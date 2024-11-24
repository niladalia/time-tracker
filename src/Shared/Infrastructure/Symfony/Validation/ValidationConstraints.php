<?php

namespace App\Shared\Infrastructure\Symfony\Validation;


use Symfony\Component\Validator\Constraints as Assert;

abstract class ValidationConstraints
{
    abstract protected function fields(): array;

    protected function fieldsConstraints(array $options): Assert\Collection
    {
        return new Assert\Collection(
            array_merge(
                [
                    'fields' => $this->fields(),
                ],
                $options,
            ),
        );
    }

    private function fieldsConstraintsAllowExtraFields(array $options): Assert\Collection
    {
        return $this->fieldsConstraints(array_merge($options, ['allowExtraFields' => true]));
    }

    public static function constraints(array $options = []): Assert\Collection
    {
        return (new static())->fieldsConstraints($options);
    }

    final protected static function type(string $type): Assert\Type
    {
        return new Assert\Type($type);
    }

    final protected static function optional(mixed $constraint): Assert\Optional
    {
        return new Assert\Optional($constraint);
    }

    final protected static function required(mixed $constraint): Assert\Required
    {
        return new Assert\Required($constraint);
    }

    protected function dateTimeConstraints():array
    {
        return [
            new Assert\Type('string'),
            new Assert\Regex([
                'pattern' => '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(\.\d+)?Z$/',
                'message' => 'This value is not a valid ISO 8601 datetime.',
            ]),
        ];

    }
}
