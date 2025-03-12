<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentAspect;
use App\Models\AssessmentCategory;
use App\Models\AssessmentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssessmentController extends BaseController
{
    public function getCategory(){
        $category = AssessmentCategory::all();
        return $this->SuccessResponse($category, 'Data kategori berhasil diambil');
    }

    public function getAspect($id){
        $aspect = AssessmentAspect::where('assesment_categories_id', $id)->get();
        if ($aspect->isEmpty()) {
            return $this->ErrorResponse('Data aspek tidak ditemukan', 404);
        }
        return $this->SuccessResponse($aspect, 'Data aspek berhasil diambil');
    }

    public function postAssessment(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'assessor_id' => 'required|exists:users,id',
            'assessment_date' => 'required|date',
            'package_id' => 'required',
            'assessment_category_id' => 'required',
            'details' => 'required|array',
            'details.*.aspect_id' => 'required|exists:assessment_aspects,id',
            'details.*.score' => 'required|numeric|min:0|max:100',
            'details.*.remarks' => 'nullable|string',
        ]);

        // dd($request->all());

        $existingAssessment = Assessment::where([
            'student_id' => $validated['student_id'],
            'assessor_id' => $validated['assessor_id'],
            'assessment_date' => $validated['assessment_date'],
            'package_id' => $validated['package_id'],
            'assessment_category_id' => $validated['assessment_category_id'],
        ])->exists();

        if ($existingAssessment) {
            return $this->ErrorResponse('Data assessment dengan kombinasi yang sama sudah ada.', 400);
        }

        DB::beginTransaction();
        try {
            $assessment = Assessment::create([
                'student_id' => $validated['student_id'],
                'assessor_id' => $validated['assessor_id'],
                'assessment_date' => $validated['assessment_date'],
                'package_id' => $validated['package_id'],
                'assessment_category_id' => $validated['assessment_category_id'],
            ]);

            $details = array_map(fn($detail) => [
                'assessment_id' => $assessment->id,
                'aspect_id' => $detail['aspect_id'],
                'score' => $detail['score'],
                'remarks' => $detail['remarks'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ], $validated['details']);

            AssessmentDetail::insert($details);

            DB::commit();

            return $this->SuccessResponse('Assessment berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->ErrorResponse('Terjadi kesalahan: ' . $e->getMessage(), 500);
        }
    }

    public function getHistory(Request $request){
        $query = Assessment::with(['student', 'assessor', 'package', 'category'])
        ->where('assessor_id', Auth::user()->id);

        $search = $request->input('search'); // Input pencarian tunggal

        if ($search) {
            $query->whereHas('package', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('category', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $assessments = $query->get();

        return $this->SuccessResponse($assessments, 'Data kategori berhasil diambil');
        }

        public function getDetailHistory($id)
        {
            $assessment = Assessment::with(['student', 'assessor', 'package', 'category'])->find($id);

            if (!$assessment) {
                return $this->ErrorResponse('Data tidak ditemukan', 404);
            }

            $assessmentDetails = AssessmentDetail::where('assessment_id', $id)->get();

            return $this->SuccessResponse([
                'assessment' => $assessment,
                'details' => $assessmentDetails
            ], 'Data detail history berhasil diambil');
    }
}
