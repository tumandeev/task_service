<?php

namespace App\Support\Traits;

trait HandlesAttachments
{
    protected function handleAttachments($model, array $attachmentFields, $data): void
    {
        array_walk($attachmentFields, function ($attachmentField) use ($model, $data) {
            if (!isset($data[$attachmentField])) return;

            $collection = 'attachments';
            $attachments = $data[$attachmentField];

            if (is_array($attachments)) {

                foreach ($attachments as $file) {
                    $this->attachFile($model, $file, $collection);
                }
                $model->{$attachmentField} = $model->getMedia($collection)->map(fn($media) => $media->getFullUrl())->toArray();

            } else {

                $this->attachFile($model, $attachments, $collection);
                $model->{$attachmentField} = $model->getMedia($collection)->first();

            }
        });
    }

    private function attachFile($model, $file, $collection): void
    {
        $model->addMedia($file)->preservingOriginal()->toMediaCollection($collection);
    }
}
