import { Head, Link } from '@inertiajs/react';

interface Adoption {
  id: number;
  adoption_fee: number;
  approval_status: string;
  adoption_date: string | null;
  shelter_animal: {
    pet_name: string;
    animal_type: string;
    microchip_id: string;
  };
  adopter: {
    name: string;
    phone: string;
  };
}

interface Props {
  adoptions: {
    data: Adoption[];
    links: any;
  };
}

export default function Index({ adoptions }: Props) {
  return (
    <>
      <Head title="Adoptions" />

      <div className="max-w-7xl mx-auto py-8 px-4">
        <div className="flex justify-between items-center mb-6">
          <h1 className="text-2xl font-bold">Adoption Records</h1>
          <Link
            href={route('adoptions.create')}
            className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm"
          >
            + New Adoption Request
          </Link>
        </div>

        <div className="bg-white shadow rounded-lg overflow-hidden">
          <table className="min-w-full divide-y divide-gray-200">
            <thead className="bg-gray-50">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Animal</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Microchip</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adopter</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fee</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {adoptions.data.length === 0 ? (
                <tr>
                  <td colSpan={7} className="px-6 py-10 text-center text-gray-500">
                    No adoption records found.
                  </td>
                </tr>
              ) : (
                adoptions.data.map((adoption) => (
                  <tr key={adoption.id} className="hover:bg-gray-50">
                    <td className="px-6 py-4">
                      <div className="font-medium">{adoption.shelter_animal?.pet_name}</div>
                      <div className="text-sm text-gray-500">{adoption.shelter_animal?.animal_type}</div>
                    </td>
                    <td className="px-6 py-4 font-mono text-sm">
                      {adoption.shelter_animal?.microchip_id}
                    </td>
                    <td className="px-6 py-4">{adoption.adopter?.name}</td>
                    <td className="px-6 py-4">{adoption.adopter?.phone}</td>
                    <td className="px-6 py-4">${Number(adoption.adoption_fee).toFixed(2)}</td>
                    <td className="px-6 py-4">
                      <span className={`px-2 py-1 text-xs rounded-full ${
                        adoption.approval_status === 'Approved' ? 'bg-green-100 text-green-800' :
                        adoption.approval_status === 'Rejected' ? 'bg-red-100 text-red-800' :
                        'bg-yellow-100 text-yellow-800'
                      }`}>
                        {adoption.approval_status}
                      </span>
                    </td>
                    <td className="px-6 py-4">
                      {adoption.adoption_date ? new Date(adoption.adoption_date).toLocaleDateString() : '—'}
                    </td>
                  </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>
    </>
  );
}