<?php

namespace App\Support\Traits;

trait HandlesAttachments
{
    protected function handleAttachments($model, array $attachmentFields, $data): void
    {
        array_walk($attachmentFields, function ($attachmentField) use ($model, $data) {
            if (!isset($data[$attachmentField])) return;

            $collection = $this->getCollection();
            $attachments = $data[$attachmentField];

            if (is_array($attachments)) {

                foreach ($attachments as $file) {
                    $this->attachFile($model, $file, $collection);
                }

            } else {
                $this->attachFile($model, $attachments, $collection);
            }

            $model->{$attachmentField} = $model->getMedia($collection)->map(fn($media) => $media->getFullUrl())->toArray();
        });
    }

    public function prepareFiles($model, $attachmentFields): void
    {
        array_walk($attachmentFields, function ($attachmentField) use ($model) {
            $collection = $this->getCollection();
            $model->{$attachmentField} = $model->getMedia($collection)->map(fn($media) => $media->getFullUrl())->toArray();
        });
    }

    private function attachFile($model, $file, $collection): void
    {
        $model->addMedia($file)->preservingOriginal()->toMediaCollection($collection);
    }

    private function getCollection(): string
    {
        return 'attachments';
    }
}
